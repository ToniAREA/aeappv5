@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.products.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="categories[]" id="categories" multiple>
                                @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ in_array($id, old('categories', [])) ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('categories'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('categories') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="brand_id">{{ trans('cruds.product.fields.brand') }}</label>
                            <select class="form-control select2" name="brand_id" id="brand_id">
                                @foreach($brands as $id => $entry)
                                    <option value="{{ $id }}" {{ old('brand_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('brand') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ref_manu">{{ trans('cruds.product.fields.ref_manu') }}</label>
                            <input class="form-control" type="text" name="ref_manu" id="ref_manu" value="{{ old('ref_manu', '') }}">
                            @if($errors->has('ref_manu'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ref_manu') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.ref_manu_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="ref_provider">{{ trans('cruds.product.fields.ref_provider') }}</label>
                            <input class="form-control" type="text" name="ref_provider" id="ref_provider" value="{{ old('ref_provider', '') }}">
                            @if($errors->has('ref_provider'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('ref_provider') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.ref_provider_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="model">{{ trans('cruds.product.fields.model') }}</label>
                            <input class="form-control" type="text" name="model" id="model" value="{{ old('model', '') }}">
                            @if($errors->has('model'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('model') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.model_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_slug">{{ trans('cruds.product.fields.product_slug') }}</label>
                            <input class="form-control" type="text" name="product_slug" id="product_slug" value="{{ old('product_slug', '') }}">
                            @if($errors->has('product_slug'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_slug') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.product_slug_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="short_desc">{{ trans('cruds.product.fields.short_desc') }}</label>
                            <textarea class="form-control ckeditor" name="short_desc" id="short_desc">{!! old('short_desc') !!}</textarea>
                            @if($errors->has('short_desc'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('short_desc') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.short_desc_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                            <textarea class="form-control ckeditor" name="description" id="description">{!! old('description') !!}</textarea>
                            @if($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="photos">{{ trans('cruds.product.fields.photos') }}</label>
                            <div class="needsclick dropzone" id="photos-dropzone">
                            </div>
                            @if($errors->has('photos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('photos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.photos_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                            <input class="form-control" type="number" name="price" id="price" value="{{ old('price', '') }}" step="0.01" required>
                            @if($errors->has('price'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pro_discount">{{ trans('cruds.product.fields.pro_discount') }}</label>
                            <input class="form-control" type="number" name="pro_discount" id="pro_discount" value="{{ old('pro_discount', '') }}" step="0.01" max="100">
                            @if($errors->has('pro_discount'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('pro_discount') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.pro_discount_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                            <input class="form-control" type="text" name="stock" id="stock" value="{{ old('stock', '') }}">
                            @if($errors->has('stock'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('stock') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="local_stock">{{ trans('cruds.product.fields.local_stock') }}</label>
                            <input class="form-control" type="number" name="local_stock" id="local_stock" value="{{ old('local_stock', '') }}" step="1">
                            @if($errors->has('local_stock'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('local_stock') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.local_stock_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="product_location_id">{{ trans('cruds.product.fields.product_location') }}</label>
                            <select class="form-control select2" name="product_location_id" id="product_location_id">
                                @foreach($product_locations as $id => $entry)
                                    <option value="{{ $id }}" {{ old('product_location_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('product_location'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('product_location') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.product_location_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="tags[]" id="tags" multiple>
                                @foreach($tags as $id => $tag)
                                    <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('tags'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tags') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="file">{{ trans('cruds.product.fields.file') }}</label>
                            <div class="needsclick dropzone" id="file-dropzone">
                            </div>
                            @if($errors->has('file'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('file') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.file_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
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
                xhr.open('POST', '{{ route('frontend.products.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $product->id ?? 0 }}');
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
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('frontend.products.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($product) && $product->photos)
      var files = {!! json_encode($product->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
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
    url: '{{ route('frontend.products.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
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
@if(isset($product) && $product->file)
          var files =
            {!! json_encode($product->file) !!}
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