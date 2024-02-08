<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CahierchargeResource;
use App\Http\Resources\CahierchargeCollection;

class SiteCahierchargesController extends Controller
{
    public function index(Request $request, Site $site): CahierchargeCollection
    {
        $this->authorize('view', $site);

        $search = $request->get('search', '');

        $cahiercharges = $site
            ->cahiercharges()
            ->search($search)
            ->latest()
            ->paginate();

        return new CahierchargeCollection($cahiercharges);
    }

    public function store(Request $request, Site $site): CahierchargeResource
    {
        $this->authorize('create', Cahiercharge::class);

        $validated = $request->validate([
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
        ]);

        $cahiercharge = $site->cahiercharges()->create($validated);

        return new CahierchargeResource($cahiercharge);
    }
}
