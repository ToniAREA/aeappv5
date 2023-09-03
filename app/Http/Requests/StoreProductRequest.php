<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'ref_manu' => [
                'string',
                'nullable',
            ],
            'ref_provider' => [
                'string',
                'nullable',
            ],
            'model' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'required',
            ],
            'product_slug' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
            'price' => [
                'required',
            ],
            'pro_discount' => [
                'numeric',
                'min:0',
                'max:100',
            ],
            'stock' => [
                'string',
                'nullable',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'file' => [
                'array',
            ],
        ];
    }
}
