<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AtributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'name' => 'required|max:255',
            'parent_id' => 'required',
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
            'name.required' => 'Attribute title is required!!',
            'parent_id.required' => 'Attribute Parent is required!!',
        ];
    }
}
