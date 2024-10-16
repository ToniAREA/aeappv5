@extends('layouts.frontend')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"
                        style="font-weight: bold; text-transform: uppercase; display: flex; justify-content: space-between; align-items: center; padding-top: 5px; padding-bottom: 5px;">
                        <span>
                            {{ trans('cruds.toDo.title_singular') }} {{ trans('global.list') }}
                        </span>
                        @can('to_do_create')
                            <span>
                                <a class="btn btn-success" href="{{ route('frontend.to-dos.create') }}">
                                    {{ trans('global.add') }} {{ trans('cruds.toDo.title_singular') }}
                                </a>
                            </span>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered datatable datatable-ToDo">
                                <thead>
                                    <tr>
                                        <th>{{ trans('cruds.toDo.fields.id') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.task') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.photos') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.for_role') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.for_employee') }}</th>
                                        <th>{{ trans('cruds.employee.fields.namecomplete') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.deadline') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.priority') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.is_repetitive') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.repeat_interval_value') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.repeat_interval_unit') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.internal_notes') }}</th>
                                        <th>{{ trans('cruds.toDo.fields.completed_at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($toDos as $key => $toDo)
                                        <tr data-entry-id="{{ $toDo->id }}"
                                            onclick="window.location.href='{{ route('frontend.to-dos.show', $toDo->id) }}'"
                                            style="cursor: pointer;">
                                            <td style="text-align: center">{{ $toDo->id ?? '' }}</td>
                                            <td>{{ $toDo->task ?? '' }}</td>
                                            <td>
                                                @foreach ($toDo->photos as $key => $media)
                                                    <a href="{{ $media->getUrl() }}" target="_blank"
                                                        style="display: inline-block">
                                                        <img src="{{ $media->getUrl('thumb') }}">
                                                    </a>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($toDo->for_roles as $key => $item)
                                                    <span>{{ $item->title }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $toDo->for_employee->id_employee ?? '' }}</td>
                                            <td>{{ $toDo->for_employee->namecomplete ?? '' }}</td>
                                            <td>{{ $toDo->deadline ?? '' }}</td>
                                            <td>{{ $toDo->priority ?? '' }}</td>
                                            <td>
                                                <span style="display:none">{{ $toDo->is_repetitive ?? '' }}</span>
                                                <input type="checkbox" disabled="disabled"
                                                    {{ $toDo->is_repetitive ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $toDo->repeat_interval_value ?? '' }}</td>
                                            <td>{{ App\Models\ToDo::REPEAT_INTERVAL_UNIT_SELECT[$toDo->repeat_interval_unit] ?? '' }}
                                            </td>
                                            <td>{{ $toDo->internal_notes ?? '' }}</td>
                                            <td>{{ $toDo->completed_at ?? '' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-ToDo:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })

        })
    </script>
@endsection
