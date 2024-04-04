@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.assetsRental.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assets-rentals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.id') }}
                        </th>
                        <td>
                            {{ $assetsRental->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.is_active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assetsRental->is_active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.asset') }}
                        </th>
                        <td>
                            {{ $assetsRental->asset->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.user') }}
                        </th>
                        <td>
                            {{ $assetsRental->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.client') }}
                        </th>
                        <td>
                            {{ $assetsRental->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.boat') }}
                        </th>
                        <td>
                            {{ $assetsRental->boat->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.start_date') }}
                        </th>
                        <td>
                            {{ $assetsRental->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.end_date') }}
                        </th>
                        <td>
                            {{ $assetsRental->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.rental_details') }}
                        </th>
                        <td>
                            {{ $assetsRental->rental_details }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.invoiced') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $assetsRental->invoiced ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.link') }}
                        </th>
                        <td>
                            {{ $assetsRental->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.link_description') }}
                        </th>
                        <td>
                            {{ $assetsRental->link_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.completed_at') }}
                        </th>
                        <td>
                            {{ $assetsRental->completed_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.rental_unit') }}
                        </th>
                        <td>
                            {{ App\Models\AssetsRental::RENTAL_UNIT_SELECT[$assetsRental->rental_unit] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.rental_quantity') }}
                        </th>
                        <td>
                            {{ $assetsRental->rental_quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assetsRental.fields.financial_document') }}
                        </th>
                        <td>
                            {{ $assetsRental->financial_document->reference_number ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assets-rentals.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection