@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        {{ trans('global.show') }} {{ trans('cruds.toDo.title') }}
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.to-dos.index') }}">
                                    {{ trans('global.back_to_list') }}
                                </a>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.id') }}
                                        </th>
                                        <td>
                                            {{ $toDo->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.task') }}
                                        </th>
                                        <td>
                                            {{ $toDo->task }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.notes') }}
                                        </th>
                                        <td>
                                            {!! $toDo->notes !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.photos') }}
                                        </th>
                                        <td>
                                            @foreach ($toDo->photos as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank"
                                                    style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.for_role') }}
                                        </th>
                                        <td>
                                            @foreach ($toDo->for_roles as $key => $for_role)
                                                <span class="label label-info">{{ $for_role->title }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.for_employee') }}
                                        </th>
                                        <td>
                                            {{ $toDo->for_employee->id_employee ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.deadline') }}
                                        </th>
                                        <td>
                                            {{ $toDo->deadline }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.priority') }}
                                        </th>
                                        <td>
                                            {{ $toDo->priority }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.is_repetitive') }}
                                        </th>
                                        <td>
                                            <input type="checkbox" disabled="disabled"
                                                {{ $toDo->is_repetitive ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.repeat_interval_value') }}
                                        </th>
                                        <td>
                                            {{ $toDo->repeat_interval_value }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.repeat_interval_unit') }}
                                        </th>
                                        <td>
                                            {{ App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT[$toDo->repeat_interval_unit] ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.internal_notes') }}
                                        </th>
                                        <td>
                                            {{ $toDo->internal_notes }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ trans('cruds.toDo.fields.completed_at') }}
                                        </th>
                                        <td>
                                            {{ $toDo->completed_at }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <a class="btn btn-default" href="{{ route('frontend.to-dos.index') }}">
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
