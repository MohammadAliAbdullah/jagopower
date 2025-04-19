<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone' => 'required|regex:/(0)[0-9]/|not_regex:/[a-z]/|unique:customers',
            'email' => 'required|unique:customers',
            'password' => 'required',
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
            'name.required' => 'Name is required!!',
            'phone.required' => 'Phone number is required!!',
            'phone.unique' => 'Phone number is exits!!',
            'email.required' => 'Email is required!!',
            'email.unique' => 'Email is exits!!',
        ];
    }
}
