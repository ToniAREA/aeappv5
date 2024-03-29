<?php

namespace App\Http\Requests;

use App\Models\ContactCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contact_company_edit');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'string',
                'nullable',
            ],
            'company_vat' => [
                'string',
                'nullable',
            ],
            'company_address' => [
                'string',
                'nullable',
            ],
            'company_mobile' => [
                'string',
                'nullable',
            ],
            'company_phone' => [
                'string',
                'nullable',
            ],
            'company_email' => [
                'string',
                'nullable',
            ],
            'company_website' => [
                'string',
                'nullable',
            ],
            'company_social_link' => [
                'string',
                'nullable',
            ],
            'contacts.*' => [
                'integer',
            ],
            'contacts' => [
                'array',
            ],
            'link' => [
                'string',
                'nullable',
            ],
            'link_description' => [
                'string',
                'nullable',
            ],
            'last_use' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
