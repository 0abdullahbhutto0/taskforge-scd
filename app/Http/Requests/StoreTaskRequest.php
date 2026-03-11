<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Authorization handled in the controller via Policies
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'workspace_id' => ['required', 'exists:workspaces,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', \Illuminate\Validation\Rule::enum(\App\Enums\TaskStatus::class)],
            'priority' => ['required', \Illuminate\Validation\Rule::enum(\App\Enums\TaskPriority::class)],
            'due_date' => ['nullable', 'date'],
            'assigned_to' => ['required', 'exists:users,id'],
        ];
    }
}
