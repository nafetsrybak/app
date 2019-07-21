<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoriesRequest extends Request
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
        //dd($this->route());
        switch($this->method()){
            case 'POST':{
                return [
                    //
                    'name'=>'required|string|unique:categories,name'
                ];
            }
            case 'PATCH':{
                return [
                    //
                    'name'=>'required|string|unique:categories,name,'.$this->route('categories') 
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'name.unique'=>'The category :attribute has already been taken.',
            'name.required'=>'The category :attribute field is required.'
        ];
    }
}
