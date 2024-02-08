<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteStoreRequest extends FormRequest
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
            'siret' => ['required', 'max:255', 'string'],
            'ville' => ['required', 'max:255', 'string'],
            'code_postal' => ['required', 'max:255', 'string'],
            'adresse' => ['required', 'max:255', 'string'],
            'entreprise_id' => ['required', 'exists:entreprises,id'],
        ];
    }
}
