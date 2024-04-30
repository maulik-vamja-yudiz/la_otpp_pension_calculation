<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

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
            'full_name'     => ['sometimes', 'nullable', 'string', 'min:3', 'max:255'],
            'email'         => ['sometimes', 'nullable', 'email', 'unique:admins,email,' . auth()->id()],
            'contact_no'    => ['sometimes', 'nullable', 'string', 'min:10', 'max:15'],
            'profile_photo'       => ['sometimes', 'nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }
}
