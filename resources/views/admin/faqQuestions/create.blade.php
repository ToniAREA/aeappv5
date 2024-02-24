@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.faqQuestion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <span class="text-danger">{{ $errors->first('category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('show_online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="show_online" value="0">
                    <input class="form-check-input" type="checkbox" name="show_online" id="show_online" value="1" {{ old('show_online', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_online">{{ trans('cruds.faqQuestion.fields.show_online') }}</label>
                </div>
                @if($errors->has('show_online'))
                    <span class="text-danger">{{ $errors->first('show_online') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.show_online_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="question">{{ trans('cruds.faqQuestion.fields.question') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('question') ? 'is-invalid' : '' }}" name="question" id="question">{!! old('question') !!}</textarea>
                @if($errors->has('question'))
                    <span class="text-danger">{{ $errors->first('question') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer">{{ trans('cruds.faqQuestion.fields.answer') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('answer') ? 'is-invalid' : '' }}" name="answer" id="answer">{!! old('answer') !!}</textarea>
                @if($errors->has('answer'))
                    <span class="text-danger">{{ $errors->first('answer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="view_count">{{ trans('cruds.faqQuestion.fields.view_count') }}</label>
                <input class="form-control {{ $errors->has('view_count') ? 'is-invalid' : '' }}" type="number" name="view_count" id="view_count" value="{{ old('view_count', '') }}" step="1">
                @if($errors->has('view_count'))
                    <span class="text-danger">{{ $errors->first('view_count') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.view_count_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.faq-questions.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $faqQuestion->id ?? 0 }}');
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

@endsection