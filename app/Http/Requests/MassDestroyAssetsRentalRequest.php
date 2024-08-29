<?php

namespace App\Http\Requests;

use App\Models\AssetsRental;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAssetsRentalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('assets_rental_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:assets_rentals,id',
        ];
    }
}
