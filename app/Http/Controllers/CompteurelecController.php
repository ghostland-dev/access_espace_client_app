<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\View\View;
use App\Models\Compteurelec;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CompteurelecStoreRequest;
use App\Http\Requests\CompteurelecUpdateRequest;

class CompteurelecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Compteurelec::class);

        $search = $request->get('search', '');

        $compteurelecs = Compteurelec::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.compteurelecs.index',
            compact('compteurelecs', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Compteurelec::class);

        $sites = Site::pluck('siret', 'id');

        return view('app.compteurelecs.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompteurelecStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Compteurelec::class);

        $validated = $request->validated();

        $compteurelec = Compteurelec::create($validated);

        return redirect()
            ->route('compteurelecs.edit', $compteurelec)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Compteurelec $compteurelec): View
    {
        $this->authorize('view', $compteurelec);

        return view('app.compteurelecs.show', compact('compteurelec'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Compteurelec $compteurelec): View
    {
        $this->authorize('update', $compteurelec);

        $sites = Site::pluck('siret', 'id');

        return view('app.compteurelecs.edit', compact('compteurelec', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CompteurelecUpdateRequest $request,
        Compteurelec $compteurelec
    ): RedirectResponse {
        $this->authorize('update', $compteurelec);

        $validated = $request->validated();

        $compteurelec->update($validated);

        return redirect()
            ->route('compteurelecs.edit', $compteurelec)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Compteurelec $compteurelec
    ): RedirectResponse {
        $this->authorize('delete', $compteurelec);

        $compteurelec->delete();

        return redirect()
            ->route('compteurelecs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
