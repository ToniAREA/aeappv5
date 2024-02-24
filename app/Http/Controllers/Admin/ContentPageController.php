<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentPageRequest;
use App\Http\Requests\StoreContentPageRequest;
use App\Http\Requests\UpdateContentPageRequest;
use App\Models\ContentCategory;
use App\Models\ContentPage;
use App\Models\ContentTag;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ContentPageController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('content_page_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ContentPage::with(['categories', 'tags'])->select(sprintf('%s.*', (new ContentPage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'content_page_show';
                $editGate      = 'content_page_edit';
                $deleteGate    = 'content_page_delete';
                $crudRoutePart = 'content-pages';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('show_online', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online ? 'checked' : null) . '>';
            });
            $table->editColumn('slug', function ($row) {
                return $row->slug ? $row->slug : '';
            });
            $table->editColumn('category', function ($row) {
                $labels = [];
                foreach ($row->categories as $category) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $category->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('tag', function ($row) {
                $labels = [];
                foreach ($row->tags as $tag) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $tag->name);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('featured_image', function ($row) {
                if (! $row->featured_image) {
                    return '';
                }
                $links = [];
                foreach ($row->featured_image as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('file', function ($row) {
                if (! $row->file) {
                    return '';
                }
                $links = [];
                foreach ($row->file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('seo_title', function ($row) {
                return $row->seo_title ? $row->seo_title : '';
            });
            $table->editColumn('seo_meta_description', function ($row) {
                return $row->seo_meta_description ? $row->seo_meta_description : '';
            });
            $table->editColumn('seo_slug', function ($row) {
                return $row->seo_slug ? $row->seo_slug : '';
            });
            $table->editColumn('link_a', function ($row) {
                return $row->link_a ? $row->link_a : '';
            });
            $table->editColumn('link_a_description', function ($row) {
                return $row->link_a_description ? $row->link_a_description : '';
            });
            $table->editColumn('show_online_link_a', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online_link_a ? 'checked' : null) . '>';
            });
            $table->editColumn('link_b', function ($row) {
                return $row->link_b ? $row->link_b : '';
            });
            $table->editColumn('link_b_description', function ($row) {
                return $row->link_b_description ? $row->link_b_description : '';
            });
            $table->editColumn('show_online_link_b', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->show_online_link_b ? 'checked' : null) . '>';
            });
            $table->editColumn('view_count', function ($row) {
                return $row->view_count ? $row->view_count : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'show_online', 'category', 'tag', 'featured_image', 'file', 'show_online_link_a', 'show_online_link_b']);

            return $table->make(true);
        }

        $content_categories = ContentCategory::get();
        $content_tags       = ContentTag::get();

        return view('admin.contentPages.index', compact('content_categories', 'content_tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('content_page_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');

        $tags = ContentTag::pluck('name', 'id');

        return view('admin.contentPages.create', compact('categories', 'tags'));
    }

    public function store(StoreContentPageRequest $request)
    {
        $contentPage = ContentPage::create($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        $contentPage->tags()->sync($request->input('tags', []));
        foreach ($request->input('featured_image', []) as $file) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('featured_image');
        }

        foreach ($request->input('file', []) as $file) {
            $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentPage->id]);
        }

        return redirect()->route('admin.content-pages.index');
    }

    public function edit(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = ContentCategory::pluck('name', 'id');

        $tags = ContentTag::pluck('name', 'id');

        $contentPage->load('categories', 'tags');

        return view('admin.contentPages.edit', compact('categories', 'contentPage', 'tags'));
    }

    public function update(UpdateContentPageRequest $request, ContentPage $contentPage)
    {
        $contentPage->update($request->all());
        $contentPage->categories()->sync($request->input('categories', []));
        $contentPage->tags()->sync($request->input('tags', []));
        if (count($contentPage->featured_image) > 0) {
            foreach ($contentPage->featured_image as $media) {
                if (! in_array($media->file_name, $request->input('featured_image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contentPage->featured_image->pluck('file_name')->toArray();
        foreach ($request->input('featured_image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('featured_image');
            }
        }

        if (count($contentPage->file) > 0) {
            foreach ($contentPage->file as $media) {
                if (! in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $contentPage->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $contentPage->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.content-pages.index');
    }

    public function show(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->load('categories', 'tags');

        return view('admin.contentPages.show', compact('contentPage'));
    }

    public function destroy(ContentPage $contentPage)
    {
        abort_if(Gate::denies('content_page_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentPage->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentPageRequest $request)
    {
        $contentPages = ContentPage::find(request('ids'));

        foreach ($contentPages as $contentPage) {
            $contentPage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_page_create') && Gate::denies('content_page_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentPage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
