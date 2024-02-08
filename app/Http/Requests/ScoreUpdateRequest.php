<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreUpdateRequest extends FormRequest
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
            'creditsafe' => ['required', 'numeric'],
            'elipro' => ['required', 'numeric'],
            'entreprise_id' => ['required', 'exists:entreprises,id'],
        ];
    }
}
