@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.waitingList.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.waiting-lists.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $waitingList->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.user') }}
                                    </th>
                                    <td>
                                        {{ $waitingList->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.client') }}
                                    </th>
                                    <td>
                                        {{ $waitingList->client->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.boats') }}
                                    </th>
                                    <td>
                                        @foreach($waitingList->boats as $key => $boats)
                                            <span class="label label-info">{{ $boats->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.plan') }}
                                    </th>
                                    <td>
                                        {{ $waitingList->plan->plan_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.waiting_for') }}
                                    </th>
                                    <td>
                                        {{ $waitingList->waiting_for }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.status') }}
                                    </th>
                                    <td>
                                        {{ App\Models\WaitingList::STATUS_SELECT[$waitingList->status] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.waitingList.fields.notes') }}
                                    </th>
                                    <td>
                                        {{ $waitingList->notes }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.waiting-lists.index') }}">
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