<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'deadline' => 'required|date',
            'assigned_user' => 'required|exists:users,id',
            'status' => 'required|string'
        ];
    }
}

