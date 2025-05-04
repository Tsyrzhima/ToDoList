<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateTaskRequest extends BaseTaskRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules());
    }
    public function messages(): array
    {
        return array_merge($this->baseMessages());
    }
}
