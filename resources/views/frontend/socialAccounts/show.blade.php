@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.socialAccount.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.social-accounts.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.user') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->user->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.provider') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->provider }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.id_provider') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->id_provider }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.token') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->token }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.refresh_token') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->refresh_token }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.socialAccount.fields.expires_in') }}
                                        </th>
                                        <td>
                                            {{ $socialAccount->expires_in }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.social-accounts.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
