<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\View\View;
use App\Models\Compteurgaz;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CompteurgazStoreRequest;
use App\Http\Requests\CompteurgazUpdateRequest;

class CompteurgazController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Compteurgaz::class);

        $search = $request->get('search', '');

        $compteurgazs = Compteurgaz::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.compteurgazs.index',
            compact('compteurgazs', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Compteurgaz::class);

        $sites = Site::pluck('siret', 'id');

        return view('app.compteurgazs.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompteurgazStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Compteurgaz::class);

        $validated = $request->validated();

        $compteurgaz = Compteurgaz::create($validated);

        return redirect()
            ->route('compteurgazs.edit', $compteurgaz)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Compteurgaz $compteurgaz): View
    {
        $this->authorize('view', $compteurgaz);

        return view('app.compteurgazs.show', compact('compteurgaz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Compteurgaz $compteurgaz): View
    {
        $this->authorize('update', $compteurgaz);

        $sites = Site::pluck('siret', 'id');

        return view('app.compteurgazs.edit', compact('compteurgaz', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CompteurgazUpdateRequest $request,
        Compteurgaz $compteurgaz
    ): RedirectResponse {
        $this->authorize('update', $compteurgaz);

        $validated = $request->validated();

        $compteurgaz->update($validated);

        return redirect()
            ->route('compteurgazs.edit', $compteurgaz)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Compteurgaz $compteurgaz
    ): RedirectResponse {
        $this->authorize('delete', $compteurgaz);

        $compteurgaz->delete();

        return redirect()
            ->route('compteurgazs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
