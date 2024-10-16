@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.create') }} {{ trans('cruds.contactCompany.title_singular') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('frontend.contact-companies.store') }}"
                            enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <div>
                                    <input type="hidden" name="defaulter" value="0">
                                    <input type="checkbox" name="defaulter" id="defaulter" value="1"
                                        {{ old('defaulter', 0) == 1 ? 'checked' : '' }}>
                                    <label for="defaulter">{{ trans('cruds.contactCompany.fields.defaulter') }}</label>
                                </div>
                                @if ($errors->has('defaulter'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('defaulter') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.contactCompany.fields.defaulter_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="company_name">{{ trans('cruds.contactCompany.fields.company_name') }}</label>
                                <input class="form-control" type="text" name="company_name" id="company_name"
                                    value="{{ old('company_name', '') }}">
                                @if ($errors->has('company_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_name') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_name_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="company_logo">{{ trans('cruds.contactCompany.fields.company_logo') }}</label>
                                <div class="needsclick dropzone" id="company_logo-dropzone">
                                </div>
                                @if ($errors->has('company_logo'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_logo') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_logo_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="company_vat">{{ trans('cruds.contactCompany.fields.company_vat') }}</label>
                                <input class="form-control" type="text" name="company_vat" id="company_vat"
                                    value="{{ old('company_vat', '') }}">
                                @if ($errors->has('company_vat'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_vat') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_vat_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="company_address">{{ trans('cruds.contactCompany.fields.company_address') }}</label>
                                <input class="form-control" type="text" name="company_address" id="company_address"
                                    value="{{ old('company_address', '') }}">
                                @if ($errors->has('company_address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_address') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_address_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="company_mobile">{{ trans('cruds.contactCompany.fields.company_mobile') }}</label>
                                <input class="form-control" type="text" name="company_mobile" id="company_mobile"
                                    value="{{ old('company_mobile', '') }}">
                                @if ($errors->has('company_mobile'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_mobile') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_mobile_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="company_phone">{{ trans('cruds.contactCompany.fields.company_phone') }}</label>
                                <input class="form-control" type="text" name="company_phone" id="company_phone"
                                    value="{{ old('company_phone', '') }}">
                                @if ($errors->has('company_phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_phone') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_phone_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="company_email">{{ trans('cruds.contactCompany.fields.company_email') }}</label>
                                <input class="form-control" type="text" name="company_email" id="company_email"
                                    value="{{ old('company_email', '') }}">
                                @if ($errors->has('company_email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_email') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_email_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="company_website">{{ trans('cruds.contactCompany.fields.company_website') }}</label>
                                <input class="form-control" type="text" name="company_website" id="company_website"
                                    value="{{ old('company_website', '') }}">
                                @if ($errors->has('company_website'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_website') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_website_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="company_social_link">{{ trans('cruds.contactCompany.fields.company_social_link') }}</label>
                                <input class="form-control" type="text" name="company_social_link"
                                    id="company_social_link" value="{{ old('company_social_link', '') }}">
                                @if ($errors->has('company_social_link'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_social_link') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.company_social_link_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="contacts">{{ trans('cruds.contactCompany.fields.contacts') }}</label>
                                <div style="padding-bottom: 4px">
                                    <span class="btn btn-info btn-xs select-all"
                                        style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                    <span class="btn btn-info btn-xs deselect-all"
                                        style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                </div>
                                <select class="form-control select2" name="contacts[]" id="contacts" multiple>
                                    @foreach ($contacts as $id => $contact)
                                        <option value="{{ $id }}"
                                            {{ in_array($id, old('contacts', [])) ? 'selected' : '' }}>{{ $contact }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('contacts'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('contacts') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.contactCompany.fields.contacts_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="link">{{ trans('cruds.contactCompany.fields.link') }}</label>
                                <input class="form-control" type="text" name="link" id="link"
                                    value="{{ old('link', '') }}">
                                @if ($errors->has('link'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('link') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.contactCompany.fields.link_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label
                                    for="link_description">{{ trans('cruds.contactCompany.fields.link_description') }}</label>
                                <input class="form-control" type="text" name="link_description" id="link_description"
                                    value="{{ old('link_description', '') }}">
                                @if ($errors->has('link_description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('link_description') }}
                                    </div>
                                @endif
                                <span
                                    class="help-block">{{ trans('cruds.contactCompany.fields.link_description_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="last_use">{{ trans('cruds.contactCompany.fields.last_use') }}</label>
                                <input class="form-control datetime" type="text" name="last_use" id="last_use"
                                    value="{{ old('last_use') }}">
                                @if ($errors->has('last_use'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_use') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.contactCompany.fields.last_use_helper') }}</span>
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
        Dropzone.options.companyLogoDropzone = {
            url: '{{ route('frontend.contact-companies.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="company_logo"]').remove()
                $('form').append('<input type="hidden" name="company_logo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="company_logo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($contactCompany) && $contactCompany->company_logo)
                    var file = {!! json_encode($contactCompany->company_logo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="company_logo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
