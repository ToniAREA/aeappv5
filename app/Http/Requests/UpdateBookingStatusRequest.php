<?php

namespace App\Http\Requests;

use App\Models\BookingStatus;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookingStatusRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_status_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
