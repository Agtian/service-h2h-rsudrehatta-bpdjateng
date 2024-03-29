<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'company'       => 'required',
            'project_id'    => 'required',
            'name'          => 'required',
            'email'         => 'required|email|max:255|unique:users',
            'no_hp'         => 'required|min:10',
            'password'      => 'required|min:8|confirmed',
            'terms_and_conditions'  => 'nullable'
        ];
    }
}
