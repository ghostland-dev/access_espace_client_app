<?php

namespace App\Http\Controllers\Api;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EntrepriseResource;
use App\Http\Resources\EntrepriseCollection;
use App\Http\Requests\EntrepriseStoreRequest;
use App\Http\Requests\EntrepriseUpdateRequest;

class EntrepriseController extends Controller
{
    public function index(Request $request): EntrepriseCollection
    {
        $this->authorize('view-any', Entreprise::class);

        $search = $request->get('search', '');

        $entreprises = Entreprise::search($search)
            ->latest()
            ->paginate();

        return new EntrepriseCollection($entreprises);
    }

    public function store(EntrepriseStoreRequest $request): EntrepriseResource
    {
        $this->authorize('create', Entreprise::class);

        $validated = $request->validated();

        $entreprise = Entreprise::create($validated);

        return new EntrepriseResource($entreprise);
    }

    public function show(
        Request $request,
        Entreprise $entreprise
    ): EntrepriseResource {
        $this->authorize('view', $entreprise);

        return new EntrepriseResource($entreprise);
    }

    public function update(
        EntrepriseUpdateRequest $request,
        Entreprise $entreprise
    ): EntrepriseResource {
        $this->authorize('update', $entreprise);

        $validated = $request->validated();

        $entreprise->update($validated);

        return new EntrepriseResource($entreprise);
    }

    public function destroy(Request $request, Entreprise $entreprise): Response
    {
        $this->authorize('delete', $entreprise);

        $entreprise->delete();

        return response()->noContent();
    }
}
