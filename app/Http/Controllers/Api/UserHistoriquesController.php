<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoriqueResource;
use App\Http\Resources\HistoriqueCollection;

class UserHistoriquesController extends Controller
{
    public function index(Request $request, User $user): HistoriqueCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $historiques = $user
            ->historiques()
            ->search($search)
            ->latest()
            ->paginate();

        return new HistoriqueCollection($historiques);
    }

    public function store(Request $request, User $user): HistoriqueResource
    {
        $this->authorize('create', Historique::class);

        $validated = $request->validate([
            'entreprise_id' => ['required', 'exists:entreprises,id'],
            'action' => ['required', 'max:255', 'string'],
            'type' => ['required', 'max:255', 'string'],
        ]);

        $historique = $user->historiques()->create($validated);

        return new HistoriqueResource($historique);
    }
}
