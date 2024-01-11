@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.comment.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.comments.update", [$comment->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="wlist_id">{{ trans('cruds.comment.fields.wlist') }}</label>
                            <select class="form-control select2" name="wlist_id" id="wlist_id">
                                @foreach($wlists as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('wlist_id') ? old('wlist_id') : $comment->wlist->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('wlist'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('wlist') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comment.fields.wlist_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="from_user_id">{{ trans('cruds.comment.fields.from_user') }}</label>
                            <select class="form-control select2" name="from_user_id" id="from_user_id">
                                @foreach($from_users as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('from_user_id') ? old('from_user_id') : $comment->from_user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('from_user'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('from_user') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comment.fields.from_user_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="comment">{{ trans('cruds.comment.fields.comment') }}</label>
                            <textarea class="form-control" name="comment" id="comment">{{ old('comment', $comment->comment) }}</textarea>
                            @if($errors->has('comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comment.fields.comment_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="private_comment">{{ trans('cruds.comment.fields.private_comment') }}</label>
                            <input class="form-control" type="text" name="private_comment" id="private_comment" value="{{ old('private_comment', $comment->private_comment) }}">
                            @if($errors->has('private_comment'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('private_comment') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comment.fields.private_comment_helper') }}</span>
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