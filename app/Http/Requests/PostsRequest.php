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
        return [
            //
            'title'=>'required|string',
            'body'=>'required|string',
            'category_id'=>'required|integer',
            'photo_id'=>'required|file|max:5000|mimes:jpeg,bmp,png'
        ];
    }

    public function messages()
    {
        return [
            'category_id.integer'=>'Please choose category!'
        ];
    }
}
