<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompteurgazResource;
use App\Http\Resources\CompteurgazCollection;

class SiteCompteurgazsController extends Controller
{
    public function index(Request $request, Site $site): CompteurgazCollection
    {
        $this->authorize('view', $site);

        $search = $request->get('search', '');

        $compteurgazs = $site
            ->compteurgazs()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompteurgazCollection($compteurgazs);
    }

    public function store(Request $request, Site $site): CompteurgazResource
    {
        $this->authorize('create', Compteurgaz::class);

        $validated = $request->validate([
            'PCE' => ['required', 'max:255', 'string'],
        ]);

        $compteurgaz = $site->compteurgazs()->create($validated);

        return new CompteurgazResource($compteurgaz);
    }
}
