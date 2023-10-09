<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisputeRequest extends FormRequest
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
            'title'=> 'required|max:70|min:10',
            'message'=> 'required|min:30|max:200'
        ];
    }
}
