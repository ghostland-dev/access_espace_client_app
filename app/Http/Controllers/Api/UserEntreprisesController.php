<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntrepriseResource;
use App\Http\Resources\EntrepriseCollection;

class UserEntreprisesController extends Controller
{
    public function index(Request $request, User $user): EntrepriseCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $entreprises = $user
            ->entreprises()
            ->search($search)
            ->latest()
            ->paginate();

        return new EntrepriseCollection($entreprises);
    }

    public function store(Request $request, User $user): EntrepriseResource
    {
        $this->authorize('create', Entreprise::class);

        $validated = $request->validate([
            'raison_sociale' => ['nullable', 'max:255', 'string'],
            'siren' => ['nullable', 'max:255', 'string'],
            'siret' => ['nullable', 'max:255', 'string'],
            'ville' => ['required', 'max:255', 'string'],
            'code_postal' => ['required', 'max:255', 'string'],
            'adresse' => ['required', 'max:255', 'string'],
            'details' => ['required', 'max:255', 'string'],
        ]);

        $entreprise = $user->entreprises()->create($validated);

        return new EntrepriseResource($entreprise);
    }
}
