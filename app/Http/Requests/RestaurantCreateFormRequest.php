<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestaurantCreateFormRequest extends FormRequest
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
            'name' => ['required', 'string', Rule::unique('restaurants')->ignore($this->route()->parameter('restaurant'))],
            'image' => ['image', 'mimes:png,jpg,jpeg', 'max:3072'],
            'location' => ['required', 'string'],
            'phone' => ['required', 'string', 'numeric'],
            'latitude' => ['required', 'decimal:2,16'],
            'longitude' => ['required', 'decimal:2,16'],
            'description' => ['nullable'],
            'email' => ['required', 'email', Rule::unique('restaurants')->ignore($this->route()->parameter('restaurant'))],
            'password' => ['required', 'min:8', 'max:20', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }
    public function messages() {
        return [
            'latitude.required' => 'Veuillez choisir la localisation du restaurant sur la carte.',

            'longitude.required' => 'Ce champ est requis.',

            'name.required' => 'Ce champ est requis.',
            'name.string' => 'Ce champ doit contenir une chaîne de caractères.',
            'name.unique' => 'Ce nom existe déjà.',

            'phone.required' => 'Ce champ est requis.',
            'phone.numeric' => 'Ce champ doit contenir un numéro de téléphone.',

            'image.required' => 'Ce champ est requis.',
            'image.image' => 'Ce champ doit contenir une image.',
            'image.max' => 'Taille max : 3 Mo.',
            'image.mimes' => 'Formats autorisés : jpg, jpeg, png',

            'location.required' => 'Ce champ est requis.',
            'location.string' => 'Ce champ doit contenir une chaîne de caractères.',

            'description.required' => 'Ce champ est requis.',

            'email.required' => 'Ce champ est requis.',
            'email.email' => 'Le format de l\'adresse email est invalide.',
            'email.unique' => 'Cette adresse email existe déjà.',

            'password_confirmation.required' => 'Ce champ est obligatoire.',
            'password_confirmation.confirmed' => 'Mot de passe différents.',

            'password.required' => 'Ce champ est obligatoire.',
            'password.confirmed' => 'Mot de passe différents.',
            'password.min' => 'Ce champ doit avoir au minimum 8 caractères.',
            'password.max' => 'Ce champ doit avoir au plus 20 caractères.',

        ];
    }
}