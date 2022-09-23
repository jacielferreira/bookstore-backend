<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        return [
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->email)
            ]
        ];
    }

    public function messages()
    {
       return [
           'name.required' => 'This field is required.',
           'name.string' => 'This field not permitted numbers.',
           'email.required' => 'This field is required',
           'email.email' => 'This email is invalid.',
           'email.unique' => 'This email has already been registered in the system.',
       ];
    }
}
