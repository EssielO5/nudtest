<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCreateFormRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('clients')->ignore($this->route()->parameter('client'))],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email', Rule::unique('clients')->ignore($this->route()->parameter('client'))],
            'password' => ['required', 'min:8', 'max:20'],
        ];
    }

    public function messages() {
        return [
            'phone.required' => 'Ce champ est requis.',
            'phone.numeric' => 'Ce champ doit contenir un numéro de téléphone.',

            'name.required' => 'Ce champ est requis.',
            'name.string' => 'Ce champ doit contenir une chaîne de caractères.',
            'name.unique' => 'Ce nom existe déjà.',

            'email.required' => 'Ce champ est requis.',
            'email.string' => 'Le format de l\'adresse email est invalide.',
            'email.unique' => 'Cette adresse email existe déjà.',

            'password.required' => 'Ce champ est obligatoire.',
            'password.min' => 'Ce champ doit avoir au minimum 8 caractères.',
            'password.max' => 'Ce champ doit avoir au plus 20 caractères.',
        ];
    }

}