<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientCreateCommentRequest extends FormRequest
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
            'client_id' => 'required',
            'order_id' => 'required',
            'restaurant_id' => 'required',
            'comment' => ['required', Rule::unique('comments')->ignore($this->route()->parameter('comment'))],
        ];
    }

    public function messages() {
        return [
            'comment.required' => 'Ce champ est requis.',
            'comment.unique' => 'Ce nom existe déjà.',
        ];
    }
}