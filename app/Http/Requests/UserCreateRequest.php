<?php

namespace App\Http\Requests;



class UserCreateRequest extends FormRequest
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
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Требуется заполнить name!',
            'surname.required' => 'Требуется заполнить surname!',
            'email.required' => 'Требуется заполнить email!',
            'phone.required' => 'Требуется заполнить phone!',
            'email.unique' => 'Такой email уже существует',
            'phone.unique' => 'Такой phone уже существует'
        ];
    }
}
