@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.product.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.products.update", [$product->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('is_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="is_online" value="0">
                    <input class="form-check-input" type="checkbox" name="is_online" id="is_online" value="1" {{ $product->is_online || old('is_online', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_online">{{ trans('cruds.product.fields.is_online') }}</label>
                </div>
                @if($errors->has('is_online'))
                    <span class="text-danger">{{ $errors->first('is_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.is_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="categories">{{ trans('cruds.product.fields.category') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories[]" id="categories" multiple>
                    @foreach($categories as $id => $category)
                        <option value="{{ $id }}" {{ (in_array($id, old('categories', [])) || $product->categories->contains($id)) ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('categories'))
                    <span class="text-danger">{{ $errors->first('categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="brand_id">{{ trans('cruds.product.fields.brand') }}</label>
                <select class="form-control select2 {{ $errors->has('brand') ? 'is-invalid' : '' }}" name="brand_id" id="brand_id">
                    @foreach($brands as $id => $entry)
                        <option value="{{ $id }}" {{ (old('brand_id') ? old('brand_id') : $product->brand->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('brand'))
                    <span class="text-danger">{{ $errors->first('brand') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_manu">{{ trans('cruds.product.fields.ref_manu') }}</label>
                <input class="form-control {{ $errors->has('ref_manu') ? 'is-invalid' : '' }}" type="text" name="ref_manu" id="ref_manu" value="{{ old('ref_manu', $product->ref_manu) }}">
                @if($errors->has('ref_manu'))
                    <span class="text-danger">{{ $errors->first('ref_manu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.ref_manu_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="providers">{{ trans('cruds.product.fields.providers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('providers') ? 'is-invalid' : '' }}" name="providers[]" id="providers" multiple>
                    @foreach($providers as $id => $provider)
                        <option value="{{ $id }}" {{ (in_array($id, old('providers', [])) || $product->providers->contains($id)) ? 'selected' : '' }}>{{ $provider }}</option>
                    @endforeach
                </select>
                @if($errors->has('providers'))
                    <span class="text-danger">{{ $errors->first('providers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.providers_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ref_provider">{{ trans('cruds.product.fields.ref_provider') }}</label>
                <input class="form-control {{ $errors->has('ref_provider') ? 'is-invalid' : '' }}" type="text" name="ref_provider" id="ref_provider" value="{{ old('ref_provider', $product->ref_provider) }}">
                @if($errors->has('ref_provider'))
                    <span class="text-danger">{{ $errors->first('ref_provider') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.ref_provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="model">{{ trans('cruds.product.fields.model') }}</label>
                <input class="form-control {{ $errors->has('model') ? 'is-invalid' : '' }}" type="text" name="model" id="model" value="{{ old('model', $product->model) }}">
                @if($errors->has('model'))
                    <span class="text-danger">{{ $errors->first('model') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.model_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="short_desc">{{ trans('cruds.product.fields.short_desc') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('short_desc') ? 'is-invalid' : '' }}" name="short_desc" id="short_desc">{!! old('short_desc', $product->short_desc) !!}</textarea>
                @if($errors->has('short_desc'))
                    <span class="text-danger">{{ $errors->first('short_desc') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.short_desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description', $product->description) !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.product.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <span class="text-danger">{{ $errors->first('photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.photos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_price">{{ trans('cruds.product.fields.product_price') }}</label>
                <input class="form-control {{ $errors->has('product_price') ? 'is-invalid' : '' }}" type="number" name="product_price" id="product_price" value="{{ old('product_price', $product->product_price) }}" step="0.01">
                @if($errors->has('product_price'))
                    <span class="text-danger">{{ $errors->first('product_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="purchase_discount">{{ trans('cruds.product.fields.purchase_discount') }}</label>
                <input class="form-control {{ $errors->has('purchase_discount') ? 'is-invalid' : '' }}" type="number" name="purchase_discount" id="purchase_discount" value="{{ old('purchase_discount', $product->purchase_discount) }}" step="0.01">
                @if($errors->has('purchase_discount'))
                    <span class="text-danger">{{ $errors->first('purchase_discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.purchase_discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="purchase_price">{{ trans('cruds.product.fields.purchase_price') }}</label>
                <input class="form-control {{ $errors->has('purchase_price') ? 'is-invalid' : '' }}" type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" step="0.01">
                @if($errors->has('purchase_price'))
                    <span class="text-danger">{{ $errors->first('purchase_price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.purchase_price_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('has_stock') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="has_stock" value="0">
                    <input class="form-check-input" type="checkbox" name="has_stock" id="has_stock" value="1" {{ $product->has_stock || old('has_stock', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="has_stock">{{ trans('cruds.product.fields.has_stock') }}</label>
                </div>
                @if($errors->has('has_stock'))
                    <span class="text-danger">{{ $errors->first('has_stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.has_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="stock">{{ trans('cruds.product.fields.stock') }}</label>
                <input class="form-control {{ $errors->has('stock') ? 'is-invalid' : '' }}" type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" step="1">
                @if($errors->has('stock'))
                    <span class="text-danger">{{ $errors->first('stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="local_stock">{{ trans('cruds.product.fields.local_stock') }}</label>
                <input class="form-control {{ $errors->has('local_stock') ? 'is-invalid' : '' }}" type="number" name="local_stock" id="local_stock" value="{{ old('local_stock', $product->local_stock) }}" step="1">
                @if($errors->has('local_stock'))
                    <span class="text-danger">{{ $errors->first('local_stock') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.local_stock_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="product_location_id">{{ trans('cruds.product.fields.product_location') }}</label>
                <select class="form-control select2 {{ $errors->has('product_location') ? 'is-invalid' : '' }}" name="product_location_id" id="product_location_id">
                    @foreach($product_locations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('product_location_id') ? old('product_location_id') : $product->product_location->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('product_location'))
                    <span class="text-danger">{{ $errors->first('product_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.product_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.product.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $product->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.tag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a">{{ trans('cruds.product.fields.link_a') }}</label>
                <input class="form-control {{ $errors->has('link_a') ? 'is-invalid' : '' }}" type="text" name="link_a" id="link_a" value="{{ old('link_a', $product->link_a) }}">
                @if($errors->has('link_a'))
                    <span class="text-danger">{{ $errors->first('link_a') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.link_a_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_a_description">{{ trans('cruds.product.fields.link_a_description') }}</label>
                <input class="form-control {{ $errors->has('link_a_description') ? 'is-invalid' : '' }}" type="text" name="link_a_description" id="link_a_description" value="{{ old('link_a_description', $product->link_a_description) }}">
                @if($errors->has('link_a_description'))
                    <span class="text-danger">{{ $errors->first('link_a_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.link_a_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b">{{ trans('cruds.product.fields.link_b') }}</label>
                <input class="form-control {{ $errors->has('link_b') ? 'is-invalid' : '' }}" type="text" name="link_b" id="link_b" value="{{ old('link_b', $product->link_b) }}">
                @if($errors->has('link_b'))
                    <span class="text-danger">{{ $errors->first('link_b') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.link_b_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link_b_description">{{ trans('cruds.product.fields.link_b_description') }}</label>
                <input class="form-control {{ $errors->has('link_b_description') ? 'is-invalid' : '' }}" type="text" name="link_b_description" id="link_b_description" value="{{ old('link_b_description', $product->link_b_description) }}">
                @if($errors->has('link_b_description'))
                    <span class="text-danger">{{ $errors->first('link_b_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.link_b_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_title">{{ trans('cruds.product.fields.seo_title') }}</label>
                <input class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" type="text" name="seo_title" id="seo_title" value="{{ old('seo_title', $product->seo_title) }}">
                @if($errors->has('seo_title'))
                    <span class="text-danger">{{ $errors->first('seo_title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.seo_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_meta_description">{{ trans('cruds.product.fields.seo_meta_description') }}</label>
                <input class="form-control {{ $errors->has('seo_meta_description') ? 'is-invalid' : '' }}" type="text" name="seo_meta_description" id="seo_meta_description" value="{{ old('seo_meta_description', $product->seo_meta_description) }}">
                @if($errors->has('seo_meta_description'))
                    <span class="text-danger">{{ $errors->first('seo_meta_description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.seo_meta_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="seo_slug">{{ trans('cruds.product.fields.seo_slug') }}</label>
                <input class="form-control {{ $errors->has('seo_slug') ? 'is-invalid' : '' }}" type="text" name="seo_slug" id="seo_slug" value="{{ old('seo_slug', $product->seo_slug) }}">
                @if($errors->has('seo_slug'))
                    <span class="text-danger">{{ $errors->first('seo_slug') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.product.fields.seo_slug_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.products.storeCKEditorImages') }}', true);
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
    url: '{{ route('admin.products.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
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
@endsection