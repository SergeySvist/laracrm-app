<?php

namespace App\Http\Requests;

use App\Exceptions\ApiValidationExeption;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
   protected function failedValidation(Validator $validator)
   {
        throw new ApiValidationExeption($validator);
   }
}
