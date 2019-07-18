<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
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
     * The route to redirect to if validation fails.
     *
     * @var string
     */
    //protected $redirectRoute = 'login';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'role_id'=>'required|integer|exists:roles,id',
            'is_active'=>'required|integer|min:0|max:1',
            'password'=>'required|string',
            'file'=>'file|max:2000|mimes:jpeg,bmp,png'
        ];
    }

    public function messages()
    {
        return [
            'role_id.required'=>'The :attribute field is required!',
            'role_id.integer'=>'Please choose role!',
            'title.min'=>'The :attribute must be at least :min characters!'
        ];
    }
}
