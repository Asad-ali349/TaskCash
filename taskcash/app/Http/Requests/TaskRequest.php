<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'=> 'required|max:100|min:10',
            'category_id'=> 'required',
            'description'=> 'required|max:200|min:20',
            'link'=> 'required|url',
            'acts'=> "required|array",
            'acts.*'=> "required|string|distinct",
            'nos.*'=> 'required|numeric',
            'total_amount'=> 'required|numeric|min:2'
        ];
    }

    public function messages()
    {
        return [
            'acts.*.required'=> 'Ingredient name and quantity should be defined!',
            'nos.*.required'=> 'Please Enter Number of acts on this activity!',
            'nos.*.numeric'=> 'Please Enter Numeric Value!',
        ];
    }
}
