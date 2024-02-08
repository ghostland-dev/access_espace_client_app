<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CahierchargeStoreRequest extends FormRequest
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
            'duree_contrat' => [
                'required',
                'in:sans engagement,12 mois,24 mois,36 mois',
            ],
            'energie_verte' => ['required', 'in:oui,non'],
            'encouter_les_opportunites' => ['required', 'boolean'],
            'frequence_facturation' => [
                'required',
                'in:mensuelle,biimensuelle,trimensuelle,annuelle',
            ],
            'type_offre' => [
                'required',
                'in:prix fix 100% marché,prix indexé arenh',
            ],
            'mode_paiement' => [
                'required',
                'in:prélevement bancaire,virement bancaire,chéque,carte banciare',
            ],
            'offre_fournisseur' => [
                'required',
                'in:offre à titre indicative,offre réel et fermé',
            ],
            'site_id' => ['required', 'exists:sites,id'],
        ];
    }
}
