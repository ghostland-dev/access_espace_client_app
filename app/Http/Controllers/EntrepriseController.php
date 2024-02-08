<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EntrepriseStoreRequest;
use App\Http\Requests\EntrepriseUpdateRequest;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Entreprise::class);

        $search = $request->get('search', '');

        $entreprises = Entreprise::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.entreprises.index', compact('entreprises', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Entreprise::class);

        $users = User::pluck('name', 'id');

        return view('app.entreprises.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EntrepriseStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Entreprise::class);

        $validated = $request->validated();

        $entreprise = Entreprise::create($validated);

        return redirect()
            ->route('entreprises.edit', $entreprise)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Entreprise $entreprise): View
    {
        $this->authorize('view', $entreprise);

        return view('app.entreprises.show', compact('entreprise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Entreprise $entreprise): View
    {
        $this->authorize('update', $entreprise);

        $users = User::pluck('name', 'id');

        return view('app.entreprises.edit', compact('entreprise', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EntrepriseUpdateRequest $request,
        Entreprise $entreprise
    ): RedirectResponse {
        $this->authorize('update', $entreprise);

        $validated = $request->validated();

        $entreprise->update($validated);

        return redirect()
            ->route('entreprises.edit', $entreprise)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Entreprise $entreprise
    ): RedirectResponse {
        $this->authorize('delete', $entreprise);

        $entreprise->delete();

        return redirect()
            ->route('entreprises.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
