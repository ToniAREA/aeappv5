<?php

namespace App\Http\Requests;

use App\Models\BookingSlot;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookingSlotRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_slot_edit');
    }

    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'integer',
            ],
            'star_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'rate_multiplier' => [
                'numeric',
                'required',
            ],
            'status_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
