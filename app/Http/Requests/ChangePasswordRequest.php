<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => 'required',
            'new_password' => 'required',
            'renewpassword' => 'same:new_password',
        ];
    }

    public function withValidator($validator){
        $validator->after(function($validator) {
            if(\Hash::check($this->password, auth()->user()->password) == false){
                $validator->errors()->add('password', 'Your password not match with current one.');
            }
        });
    }
}
