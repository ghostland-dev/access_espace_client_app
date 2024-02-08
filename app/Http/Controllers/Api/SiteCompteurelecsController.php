<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompteurelecResource;
use App\Http\Resources\CompteurelecCollection;

class SiteCompteurelecsController extends Controller
{
    public function index(Request $request, Site $site): CompteurelecCollection
    {
        $this->authorize('view', $site);

        $search = $request->get('search', '');

        $compteurelecs = $site
            ->compteurelecs()
            ->search($search)
            ->latest()
            ->paginate();

        return new CompteurelecCollection($compteurelecs);
    }

    public function store(Request $request, Site $site): CompteurelecResource
    {
        $this->authorize('create', Compteurelec::class);

        $validated = $request->validate([
            'PDL' => ['required', 'max:255', 'string'],
        ]);

        $compteurelec = $site->compteurelecs()->create($validated);

        return new CompteurelecResource($compteurelec);
    }
}
