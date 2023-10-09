<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'current_password'=> 'required|max:16|min:3',
            'vat_number' => 'max:13',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:4'
        ];
    }
}
