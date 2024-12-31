<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class ClinicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isOwner();
    }

    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email'],
            'working_hours_start' => ['required', 'date_format:H:i'],
            'working_hours_end' => ['required', 'date_format:H:i', 'after:working_hours_start'],
            'working_days' => ['required', 'array', 'min:1'],
            'working_days.*' => ['required', 'integer', 'between:0,6'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['boolean'],
        ];
    }
}