<?php

namespace App\Http\Requests;

use App\Enums\TaskStatusEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function baseRules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:'.implode(',', TaskStatusEnum::values()),
        ];
    }
    public function baseMessages(): array
    {
        return [
            'title.required' => 'Поле title обязательно для заполнения',
            'title.min' => 'Поле title должно быть больше 3 символов',
            'title.max' => 'Поле title не должно превышать больше 255 символов',
            'status.in' => 'Недопустимый status задачи. Допустимые status: pending, in_progress or completed',
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => $validator->errors(),
            ], 422)
        );
    }

}
