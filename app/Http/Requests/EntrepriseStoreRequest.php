<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'raison_sociale' => ['nullable', 'max:255', 'string'],
            'siren' => ['nullable', 'max:255', 'string'],
            'siret' => ['nullable', 'max:255', 'string'],
            'ville' => ['required', 'max:255', 'string'],
            'code_postal' => ['required', 'max:255', 'string'],
            'adresse' => ['required', 'max:255', 'string'],
            'details' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
