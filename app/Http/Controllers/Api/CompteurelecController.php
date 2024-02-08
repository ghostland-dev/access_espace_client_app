<?php

namespace App\Http\Controllers\Api;

use App\Models\Compteurelec;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompteurelecResource;
use App\Http\Resources\CompteurelecCollection;
use App\Http\Requests\CompteurelecStoreRequest;
use App\Http\Requests\CompteurelecUpdateRequest;

class CompteurelecController extends Controller
{
    public function index(Request $request): CompteurelecCollection
    {
        $this->authorize('view-any', Compteurelec::class);

        $search = $request->get('search', '');

        $compteurelecs = Compteurelec::search($search)
            ->latest()
            ->paginate();

        return new CompteurelecCollection($compteurelecs);
    }

    public function store(
        CompteurelecStoreRequest $request
    ): CompteurelecResource {
        $this->authorize('create', Compteurelec::class);

        $validated = $request->validated();

        $compteurelec = Compteurelec::create($validated);

        return new CompteurelecResource($compteurelec);
    }

    public function show(
        Request $request,
        Compteurelec $compteurelec
    ): CompteurelecResource {
        $this->authorize('view', $compteurelec);

        return new CompteurelecResource($compteurelec);
    }

    public function update(
        CompteurelecUpdateRequest $request,
        Compteurelec $compteurelec
    ): CompteurelecResource {
        $this->authorize('update', $compteurelec);

        $validated = $request->validated();

        $compteurelec->update($validated);

        return new CompteurelecResource($compteurelec);
    }

    public function destroy(
        Request $request,
        Compteurelec $compteurelec
    ): Response {
        $this->authorize('delete', $compteurelec);

        $compteurelec->delete();

        return response()->noContent();
    }
}
