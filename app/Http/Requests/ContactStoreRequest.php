<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
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
            'civilite' => ['required', 'max:255', 'string'],
            'nom' => ['required', 'max:255', 'string'],
            'prenom' => ['required', 'max:255', 'string'],
            'fonction' => ['required', 'max:255', 'string'],
            'mobile' => ['required', 'max:255', 'string'],
            'fix' => ['required', 'max:255', 'string'],
            'signataire' => ['required', 'boolean'],
            'decisionnaire' => ['required', 'boolean'],
            'site_id' => ['required', 'exists:sites,id'],
        ];
    }
}
