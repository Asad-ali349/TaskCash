<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=> 'required|max:30',
            'email'=> 'required|email|unique:users',
            'phone'=> 'required|max:30',
            'image'=> 'nullable|image|max:2000',
            'vat_number' => 'max:13',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ];
    }

    public function messages(){
        return [
          'password.confirmed'=> "passwords didn't match",
        ];
    }
}
