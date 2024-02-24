<?php

namespace App\Http\Requests;

use App\Models\ContentPage;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreContentPageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('content_page_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'featured_image' => [
                'array',
            ],
            'file' => [
                'array',
            ],
            'seo_title' => [
                'string',
                'nullable',
            ],
            'seo_meta_description' => [
                'string',
                'nullable',
            ],
            'seo_slug' => [
                'string',
                'nullable',
            ],
            'link_a' => [
                'string',
                'nullable',
            ],
            'link_a_description' => [
                'string',
                'nullable',
            ],
            'link_b' => [
                'string',
                'nullable',
            ],
            'link_b_description' => [
                'string',
                'nullable',
            ],
            'view_count' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
