<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMlogRequest;
use App\Http\Requests\StoreMlogRequest;
use App\Http\Requests\UpdateMlogRequest;
use App\Models\Boat;
use App\Models\FinalcialDocument;
use App\Models\Mlog;
use App\Models\Product;
use App\Models\User;
use App\Models\Wlist;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MlogsController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('mlog_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Mlog::with(['boat', 'wlist', 'employee', 'product', 'financial_document'])->select(sprintf('%s.*', (new Mlog)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'mlog_show';
                $editGate      = 'mlog_edit';
                $deleteGate    = 'mlog_delete';
                $crudRoutePart = 'mlogs';

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
            $table->addColumn('boat_name', function ($row) {
                return $row->boat ? $row->boat->name : '';
            });

            $table->editColumn('boat_namecomplete', function ($row) {
                return $row->boat_namecomplete ? $row->boat_namecomplete : '';
            });
            $table->addColumn('wlist_description', function ($row) {
                return $row->wlist ? $row->wlist->description : '';
            });

            $table->addColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });

            $table->editColumn('employee.email', function ($row) {
                return $row->employee ? (is_string($row->employee) ? $row->employee : $row->employee->email) : '';
            });
            $table->editColumn('item', function ($row) {
                return $row->item ? $row->item : '';
            });
            $table->addColumn('product_name', function ($row) {
                return $row->product ? $row->product->name : '';
            });

            $table->editColumn('product.description', function ($row) {
                return $row->product ? (is_string($row->product) ? $row->product : $row->product->description) : '';
            });
            $table->editColumn('description', function ($row) {
                return $row->description ? $row->description : '';
            });
            $table->editColumn('photos', function ($row) {
                if (! $row->photos) {
                    return '';
                }
                $links = [];
                foreach ($row->photos as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('units', function ($row) {
                return $row->units ? $row->units : '';
            });
            $table->editColumn('price_unit', function ($row) {
                return $row->price_unit ? $row->price_unit : '';
            });
            $table->editColumn('invoiced_line', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->invoiced_line ? 'checked' : null) . '>';
            });
            $table->addColumn('financial_document_reference_number', function ($row) {
                return $row->financial_document ? $row->financial_document->reference_number : '';
            });

            $table->editColumn('financial_document.doc_type', function ($row) {
                return $row->financial_document ? (is_string($row->financial_document) ? $row->financial_document : $row->financial_document->doc_type) : '';
            });
            $table->editColumn('internal_notes', function ($row) {
                return $row->internal_notes ? $row->internal_notes : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'boat', 'wlist', 'employee', 'product', 'photos', 'invoiced_line', 'financial_document']);

            return $table->make(true);
        }

        $boats               = Boat::get();
        $wlists              = Wlist::get();
        $users               = User::get();
        $products            = Product::get();
        $finalcial_documents = FinalcialDocument::get();

        return view('admin.mlogs.index', compact('boats', 'wlists', 'users', 'products', 'finalcial_documents'));
    }

    public function create()
    {
        abort_if(Gate::denies('mlog_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mlogs.create', compact('boats', 'employees', 'financial_documents', 'products', 'wlists'));
    }

    public function store(StoreMlogRequest $request)
    {
        $mlog = Mlog::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $mlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mlog->id]);
        }

        return redirect()->route('admin.mlogs.index');
    }

    public function edit(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wlists = Wlist::pluck('description', 'id')->prepend(trans('global.pleaseSelect'), '');

        $employees = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $financial_documents = FinalcialDocument::pluck('reference_number', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mlog->load('boat', 'wlist', 'employee', 'product', 'financial_document');

        return view('admin.mlogs.edit', compact('boats', 'employees', 'financial_documents', 'mlog', 'products', 'wlists'));
    }

    public function update(UpdateMlogRequest $request, Mlog $mlog)
    {
        $mlog->update($request->all());

        if (count($mlog->photos) > 0) {
            foreach ($mlog->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $mlog->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $mlog->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.mlogs.index');
    }

    public function show(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->load('boat', 'wlist', 'employee', 'product', 'financial_document');

        return view('admin.mlogs.show', compact('mlog'));
    }

    public function destroy(Mlog $mlog)
    {
        abort_if(Gate::denies('mlog_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mlog->delete();

        return back();
    }

    public function massDestroy(MassDestroyMlogRequest $request)
    {
        $mlogs = Mlog::find(request('ids'));

        foreach ($mlogs as $mlog) {
            $mlog->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('mlog_create') && Gate::denies('mlog_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Mlog();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
