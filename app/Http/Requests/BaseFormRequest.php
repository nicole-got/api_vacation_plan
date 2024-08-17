<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Validation Error',
            'errors' => $validator->errors(),
        ], 422));
    }

    // public function messages()
    // {
    //     return [
    //         'gt'    => 'O :attribute deve ser maior que :value',
    //         'max'   => 'O :attribute não deve ser maior que :max caracteres',
    //     ];
    // }
}
