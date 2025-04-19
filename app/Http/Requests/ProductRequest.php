<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'content' => 'required',
            'images' => 'required',
            'qty' => 'required|numeric',
            'sales_price' => 'required|numeric',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        // use trans instead on Lang
        return [
            'title.required' => 'Product title is required!!',
            'category_id.required' => 'Please select a category!!',
            'content.required' => 'Product Content is required!!',
            'images.required' => 'Product images is required!!',
            'qty.min' => 'Product Qty min is 1!!',
            'sales_price.min' => 'Product Sales Price min is 1tk!!',
            'sales_price.required' => 'Product Sales Price is required!!',
        ];
    }
}
