<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostsRequest extends Request
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
        switch($this->method()){
            case 'POST':{
                return [
                    //
                    'title'=>'required|string',
                    'body'=>'required|string',
                    'category_id'=>'required|integer',
                    'photo_id'=>'required|file|max:5000|mimes:jpeg,bmp,png'
                ];
            }
            case 'PATCH':{
                return [
                    //
                    'title'=>'required|string',
                    'body'=>'required|string',
                    'category_id'=>'required|integer',
                    'photo_id'=>'file|max:5000|mimes:jpeg,bmp,png'
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'photo_id.file'=>'Is not file)',
            'photo_id.mimes'=>'The photo must be a file of type: :values.',
            'category_id.integer'=>'Please choose category!'
        ];
    }
}
