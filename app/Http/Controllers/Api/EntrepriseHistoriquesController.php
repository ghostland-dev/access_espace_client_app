<?php

namespace App\Http\Controllers\Api;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriqueResource;
use App\Http\Resources\HistoriqueCollection;

class EntrepriseHistoriquesController extends Controller
{
    public function index(
        Request $request,
        Entreprise $entreprise
    ): HistoriqueCollection {
        $this->authorize('view', $entreprise);

        $search = $request->get('search', '');

        $historiques = $entreprise
            ->historiques()
            ->search($search)
            ->latest()
            ->paginate();

        return new HistoriqueCollection($historiques);
    }

    public function store(
        Request $request,
        Entreprise $entreprise
    ): HistoriqueResource {
        $this->authorize('create', Historique::class);

        $validated = $request->validate([
            'action' => ['required', 'max:255', 'string'],
            'type' => ['required', 'max:255', 'string'],
        ]);

        $historique = $entreprise->historiques()->create($validated);

        return new HistoriqueResource($historique);
    }
}
