<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\Unique;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('super admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['string', 'confirmed', 'max:255', (new Password(8))->mixedCase()->numbers()->symbols()],
            'role_admin' => 'present|boolean',
            'role_writer' => 'present|boolean',
        ];

        if($this->isMethod('POST')) {
            $rules['name'][] = 'unique:users';
            $rules['email'][] = 'unique:users';
            $rules['password'][] = 'required';
        }

        if($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->user->id; // the user to update, not the authenticated user
            $rules['name'][] = (new Unique('users'))->ignore($id);
            $rules['email'][] = (new Unique('users'))->ignore($id);
            $rules['password'][] = 'nullable';
        }

        return $rules;
    }
}
