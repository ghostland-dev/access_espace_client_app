<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\View\View;
use App\Models\Cahiercharge;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CahierchargeStoreRequest;
use App\Http\Requests\CahierchargeUpdateRequest;

class CahierchargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Cahiercharge::class);

        $search = $request->get('search', '');

        $cahiercharges = Cahiercharge::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.cahiercharges.index',
            compact('cahiercharges', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Cahiercharge::class);

        $sites = Site::pluck('siret', 'id');

        return view('app.cahiercharges.create', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CahierchargeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Cahiercharge::class);

        $validated = $request->validated();

        $cahiercharge = Cahiercharge::create($validated);

        return redirect()
            ->route('cahiercharges.edit', $cahiercharge)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Cahiercharge $cahiercharge): View
    {
        $this->authorize('view', $cahiercharge);

        return view('app.cahiercharges.show', compact('cahiercharge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Cahiercharge $cahiercharge): View
    {
        $this->authorize('update', $cahiercharge);

        $sites = Site::pluck('siret', 'id');

        return view('app.cahiercharges.edit', compact('cahiercharge', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CahierchargeUpdateRequest $request,
        Cahiercharge $cahiercharge
    ): RedirectResponse {
        $this->authorize('update', $cahiercharge);

        $validated = $request->validated();

        $cahiercharge->update($validated);

        return redirect()
            ->route('cahiercharges.edit', $cahiercharge)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Cahiercharge $cahiercharge
    ): RedirectResponse {
        $this->authorize('delete', $cahiercharge);

        $cahiercharge->delete();

        return redirect()
            ->route('cahiercharges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
