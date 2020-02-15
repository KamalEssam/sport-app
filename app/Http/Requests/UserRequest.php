<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
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

        if($this->method() == 'PUT')
        {
            return [
                'name'     => 'required|regex:/^[أ-يa-zA-Z\s]+$/u|string|min:2|max:50',
                'email'    => 'required|string|email|unique:users,email,'.Auth::guard('api')->user()->id,
                'mobile'   => 'nullable|string',
                'image'    => 'nullable|string',
                'password' => 'nullable|string|min:6',
            ];
        }
    }
}
