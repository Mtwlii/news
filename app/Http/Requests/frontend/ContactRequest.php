<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:55'],
            'email' => ['required', 'email', 'max:80'],
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'title' => ['required', 'string', 'min:3', 'max:55'],
            'body' => ['required', 'string', 'min:10', 'max:255'],
        ];
    }
}
