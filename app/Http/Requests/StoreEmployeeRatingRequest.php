<?php

namespace App\Http\Requests;

use App\Models\EmployeeRating;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreEmployeeRatingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employee_rating_create');
    }

    public function rules()
    {
        return [
            'rating' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'comment' => [
                'string',
                'nullable',
            ],
        ];
    }
}
