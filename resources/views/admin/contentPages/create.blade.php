@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contentPage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.content-pages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.contentPage.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online" id="show_online" value="1" {{ old('show_online', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online">{{ trans('cruds.contentPage.fields.show_online') }}</label>
                </div>
                @if($errors->has('show_online'))
                    <span class="text-danger">{{ $errors->first('show_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.show_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slug">{{ trans('cruds.contentPage.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}">
                @if($errors->has('slug'))
                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.contentPage.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.contentPage.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="page_text">{{ trans('cruds.contentPage.fields.page_text') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('page_text') ? 'is-invalid' : '' }}" name="page_text" id="page_text">{!! old('page_text') !!}</textarea>
                @if($errors->has('page_text'))
                    <span class="text-danger">{{ $errors->first('page_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.page_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="excerpt">{{ trans('cruds.contentPage.fields.excerpt') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" name="excerpt" id="excerpt">{!! old('excerpt') !!}</textarea>
                @if($errors->has('excerpt'))
                    <span class="text-danger">{{ $errors->first('excerpt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.excerpt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="featured_image">{{ trans('cruds.contentPage.fields.featured_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('featured_image') ? 'is-invalid' : '' }}" id="featured_image-dropzone">
                </div>
                @if($errors->has('featured_image'))
                    <span class="text-danger">{{ $errors->first('featured_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.featured_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.contentPage.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <span class="text-danger">{{ $errors->first('file') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_title">{{ trans('cruds.contentPage.fields.seo_title') }}</label>
                <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', '') }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.seo_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_meta_description">{{ trans('cruds.contentPage.fields.seo_meta_description') }}</label>
                <input class="form-control {{ $errors->has('seo_meta_description') ? 'is-invalid' : '' }}" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', '') }}">
                @if($errors->has('seo_meta_description'))
                    <span class="text-danger">{{ $errors->first('seo_meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.seo_meta_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_slug">{{ trans('cruds.contentPage.fields.seo_slug') }}</label>
                <input class="form-control {{ $errors->has('seo_slug') ? 'is-invalid' : '' }}" type="text" name="seo_slug" id="seo_slug" value="{{ old('seo_slug', '') }}">
                @if($errors->has('seo_slug'))
                    <span class="text-danger">{{ $errors->first('seo_slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.seo_slug_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a">{{ trans('cruds.contentPage.fields.link_a') }}</label>
                <input class="form-control {{ $errors->has('link_a') ? 'is-invalid' : '' }}" type="text" name="link_a" id="link_a" value="{{ old('link_a', '') }}">
                @if($errors->has('link_a'))
                    <span class="text-danger">{{ $errors->first('link_a') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.link_a_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a_description">{{ trans('cruds.contentPage.fields.link_a_description') }}</label>
                <input class="form-control {{ $errors->has('link_a_description') ? 'is-invalid' : '' }}" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', '') }}">
                @if($errors->has('link_a_description'))
                    <span class="text-danger">{{ $errors->first('link_a_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.link_a_description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online_link_a') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online_link_a" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online_link_a" id="show_online_link_a" value="1" {{ old('show_online_link_a', 0) == 1 || old('show_online_link_a') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online_link_a">{{ trans('cruds.contentPage.fields.show_online_link_a') }}</label>
                </div>
                @if($errors->has('show_online_link_a'))
                    <span class="text-danger">{{ $errors->first('show_online_link_a') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.show_online_link_a_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b">{{ trans('cruds.contentPage.fields.link_b') }}</label>
                <input class="form-control {{ $errors->has('link_b') ? 'is-invalid' : '' }}" type="text" name="link_b" id="link_b" value="{{ old('link_b', '') }}">
                @if($errors->has('link_b'))
                    <span class="text-danger">{{ $errors->first('link_b') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.link_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b_description">{{ trans('cruds.contentPage.fields.link_b_description') }}</label>
                <input class="form-control {{ $errors->has('link_b_description') ? 'is-invalid' : '' }}" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', '') }}">
                @if($errors->has('link_b_description'))
                    <span class="text-danger">{{ $errors->first('link_b_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.link_b_description_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online_link_b') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online_link_b" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online_link_b" id="show_online_link_b" value="1" {{ old('show_online_link_b', 0) == 1 || old('show_online_link_b') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online_link_b">{{ trans('cruds.contentPage.fields.show_online_link_b') }}</label>
                </div>
                @if($errors->has('show_online_link_b'))
                    <span class="text-danger">{{ $errors->first('show_online_link_b') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.show_online_link_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="view_count">{{ trans('cruds.contentPage.fields.view_count') }}</label>
                <input class="form-control {{ $errors->has('view_count') ? 'is-invalid' : '' }}" type="number" name="view_count" id="view_count" value="{{ old('view_count', '') }}" step="1">
                @if($errors->has('view_count'))
                    <span class="text-danger">{{ $errors->first('view_count') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.view_count_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorized_roles">{{ trans('cruds.contentPage.fields.authorized_roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorized_roles') ? 'is-invalid' : '' }}" name="authorized_roles[]" id="authorized_roles" multiple>
                    @foreach($authorized_roles as $id => $authorized_role)
                        <option value="{{ $id }}" {{ in_array($id, old('authorized_roles', [])) ? 'selected' : '' }}>{{ $authorized_role }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorized_roles'))
                    <span class="text-danger">{{ $errors->first('authorized_roles') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.authorized_roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="authorized_users">{{ trans('cruds.contentPage.fields.authorized_users') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('authorized_users') ? 'is-invalid' : '' }}" name="authorized_users[]" id="authorized_users" multiple>
                    @foreach($authorized_users as $id => $authorized_user)
                        <option value="{{ $id }}" {{ in_array($id, old('authorized_users', [])) ? 'selected' : '' }}>{{ $authorized_user }}</option>
                    @endforeach
                </select>
                @if($errors->has('authorized_users'))
                    <span class="text-danger">{{ $errors->first('authorized_users') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.contentPage.fields.authorized_users_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.content-pages.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $contentPage->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedFeaturedImageMap = {}
Dropzone.options.featuredImageDropzone = {
    url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="featured_image[]" value="' + response.name + '">')
      uploadedFeaturedImageMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFeaturedImageMap[file.name]
      }
      $('form').find('input[name="featured_image[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($contentPage) && $contentPage->featured_image)
      var files = {!! json_encode($contentPage->featured_image) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="featured_image[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
<script>
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('admin.content-pages.storeMedia') }}',
    maxFilesize: 10, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 10
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($contentPage) && $contentPage->file)
          var files =
            {!! json_encode($contentPage->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection