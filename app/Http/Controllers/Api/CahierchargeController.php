<?php

namespace App\Http\Controllers\Api;

use App\Models\Cahiercharge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CahierchargeResource;
use App\Http\Resources\CahierchargeCollection;
use App\Http\Requests\CahierchargeStoreRequest;
use App\Http\Requests\CahierchargeUpdateRequest;

class CahierchargeController extends Controller
{
    public function index(Request $request): CahierchargeCollection
    {
        $this->authorize('view-any', Cahiercharge::class);

        $search = $request->get('search', '');

        $cahiercharges = Cahiercharge::search($search)
            ->latest()
            ->paginate();

        return new CahierchargeCollection($cahiercharges);
    }

    public function store(
        CahierchargeStoreRequest $request
    ): CahierchargeResource {
        $this->authorize('create', Cahiercharge::class);

        $validated = $request->validated();

        $cahiercharge = Cahiercharge::create($validated);

        return new CahierchargeResource($cahiercharge);
    }

    public function show(
        Request $request,
        Cahiercharge $cahiercharge
    ): CahierchargeResource {
        $this->authorize('view', $cahiercharge);

        return new CahierchargeResource($cahiercharge);
    }

    public function update(
        CahierchargeUpdateRequest $request,
        Cahiercharge $cahiercharge
    ): CahierchargeResource {
        $this->authorize('update', $cahiercharge);

        $validated = $request->validated();

        $cahiercharge->update($validated);

        return new CahierchargeResource($cahiercharge);
    }

    public function destroy(
        Request $request,
        Cahiercharge $cahiercharge
    ): Response {
        $this->authorize('delete', $cahiercharge);

        $cahiercharge->delete();

        return response()->noContent();
    }
}
