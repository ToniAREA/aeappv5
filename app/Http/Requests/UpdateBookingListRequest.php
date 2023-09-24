<?php

namespace App\Http\Requests;

use App\Models\BookingList;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookingListRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_list_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'boat_id' => [
                'required',
                'integer',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'hours' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'hour_rate' => [
                'numeric',
                'required',
            ],
            'total_price' => [
                'numeric',
                'required',
            ],
            'notes' => [
                'string',
                'nullable',
            ],
            'internal_notes' => [
                'string',
                'nullable',
            ],
            'confirmed' => [
                'required',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
