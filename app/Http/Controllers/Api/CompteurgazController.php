<?php

namespace App\Http\Controllers\Api;

use App\Models\Compteurgaz;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompteurgazResource;
use App\Http\Resources\CompteurgazCollection;
use App\Http\Requests\CompteurgazStoreRequest;
use App\Http\Requests\CompteurgazUpdateRequest;

class CompteurgazController extends Controller
{
    public function index(Request $request): CompteurgazCollection
    {
        $this->authorize('view-any', Compteurgaz::class);

        $search = $request->get('search', '');

        $compteurgazs = Compteurgaz::search($search)
            ->latest()
            ->paginate();

        return new CompteurgazCollection($compteurgazs);
    }

    public function store(CompteurgazStoreRequest $request): CompteurgazResource
    {
        $this->authorize('create', Compteurgaz::class);

        $validated = $request->validated();

        $compteurgaz = Compteurgaz::create($validated);

        return new CompteurgazResource($compteurgaz);
    }

    public function show(
        Request $request,
        Compteurgaz $compteurgaz
    ): CompteurgazResource {
        $this->authorize('view', $compteurgaz);

        return new CompteurgazResource($compteurgaz);
    }

    public function update(
        CompteurgazUpdateRequest $request,
        Compteurgaz $compteurgaz
    ): CompteurgazResource {
        $this->authorize('update', $compteurgaz);

        $validated = $request->validated();

        $compteurgaz->update($validated);

        return new CompteurgazResource($compteurgaz);
    }

    public function destroy(
        Request $request,
        Compteurgaz $compteurgaz
    ): Response {
        $this->authorize('delete', $compteurgaz);

        $compteurgaz->delete();

        return response()->noContent();
    }
}
