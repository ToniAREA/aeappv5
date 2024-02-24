<?php

namespace App\Http\Requests;

use App\Models\ClientsReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientsReviewRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('clients_review_edit');
    }

    public function rules()
    {
        return [
            'boats.*' => [
                'integer',
            ],
            'boats' => [
                'array',
            ],
            'for_wlists.*' => [
                'integer',
            ],
            'for_wlists' => [
                'array',
            ],
            'rating' => [
                'numeric',
            ],
        ];
    }
}
