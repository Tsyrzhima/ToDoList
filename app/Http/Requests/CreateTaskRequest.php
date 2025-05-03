<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,in_progress,completed',
            'per_page' => 'sometimes|integer|min:1|max:100',
        ];
    }
    public function messages(): array
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
