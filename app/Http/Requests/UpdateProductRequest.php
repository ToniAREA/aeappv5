<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
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
            'local_stock' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
