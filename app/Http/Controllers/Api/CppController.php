<?php

namespace App\Http\Controllers\Api;

use App\Models\Cpp;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\CppResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CppCollection;
use App\Http\Requests\CppStoreRequest;
use App\Http\Requests\CppUpdateRequest;

class CppController extends Controller
{
    public function index(Request $request): CppCollection
    {
        $this->authorize('view-any', Cpp::class);

        $search = $request->get('search', '');

        $cpps = Cpp::search($search)
            ->latest()
            ->paginate();

        return new CppCollection($cpps);
    }

    public function store(CppStoreRequest $request): CppResource
    {
        $this->authorize('create', Cpp::class);

        $validated = $request->validated();

        $cpp = Cpp::create($validated);

        return new CppResource($cpp);
    }

    public function show(Request $request, Cpp $cpp): CppResource
    {
        $this->authorize('view', $cpp);

        return new CppResource($cpp);
    }

    public function update(CppUpdateRequest $request, Cpp $cpp): CppResource
    {
        $this->authorize('update', $cpp);

        $validated = $request->validated();

        $cpp->update($validated);

        return new CppResource($cpp);
    }

    public function destroy(Request $request, Cpp $cpp): Response
    {
        $this->authorize('delete', $cpp);

        $cpp->delete();

        return response()->noContent();
    }
}
