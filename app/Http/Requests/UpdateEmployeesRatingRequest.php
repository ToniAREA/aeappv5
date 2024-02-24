<?php

namespace App\Http\Requests;

use App\Models\EmployeesRating;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateEmployeesRatingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('employees_rating_edit');
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
