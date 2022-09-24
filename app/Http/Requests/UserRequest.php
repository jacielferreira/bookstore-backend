<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{

    public function rules(Request $request)
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($request->email)
            ],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => "Validation errors",
            'data' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.rqueired' => 'Name is required',
            'name.string' => 'Name is string only',
            'email.required' => 'Email is required',
            'email.email' => 'This Email is invalid',
            'email.unique' => 'This Email already registered '
        ];
    }


}
