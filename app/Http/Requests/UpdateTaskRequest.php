<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends BaseTaskRequest
{
    public function rules(): array
    {
        return array_merge($this->baseRules(),[
            'title' => 'sometimes|string|min:3|max:255',
        ]);
    }
    public function messages(): array
    {
        return array_merge($this->baseMessages());
    }
}
