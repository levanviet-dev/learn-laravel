<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            $firstError = (collect(array_values($errors))->flatten()->first());
            throw new HttpResponseException(
                responseErrorAPI(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    ERROR_CODE_VALIDATE_FAIL,
                    $firstError
                )
            );
        }

        parent::failedValidation($validator);
    }
}
