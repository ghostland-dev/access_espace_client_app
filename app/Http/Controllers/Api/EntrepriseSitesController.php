<?php

namespace App\Http\Controllers\Api;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Http\Resources\SiteResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SiteCollection;

class EntrepriseSitesController extends Controller
{
    public function index(
        Request $request,
        Entreprise $entreprise
    ): SiteCollection {
        $this->authorize('view', $entreprise);

        $search = $request->get('search', '');

        $sites = $entreprise
            ->sites()
            ->search($search)
            ->latest()
            ->paginate();

        return new SiteCollection($sites);
    }

    public function store(
        Request $request,
        Entreprise $entreprise
    ): SiteResource {
        $this->authorize('create', Site::class);

        $validated = $request->validate([
            'siret' => ['required', 'max:255', 'string'],
            'ville' => ['required', 'max:255', 'string'],
            'code_postal' => ['required', 'max:255', 'string'],
            'adresse' => ['required', 'max:255', 'string'],
        ]);

        $site = $entreprise->sites()->create($validated);

        return new SiteResource($site);
    }
}
