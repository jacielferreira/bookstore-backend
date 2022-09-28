<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class BookRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'isbn' => [
                'required', 'numeric',
                 Rule::unique('books', 'isbn')->ignore($this->book)
            ],
            'value' => 'required|numeric|between:0,9999.99'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => "Validation errors",
            'data' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function messages()
    {
        return [
            'name.required' => 'This Name is required',
            'isbn.required' => 'This ISBN is required',
            'isbn.numeric' => 'This ISBN is invalid. Number only',
            'isbn.unique' => 'This ISBN already registered',
            'value.required' => 'This Value is required',
            'value.numeric' => 'This Value is invalid',
            'value.between' => 'Decimal number only'
        ];
    }
}
