<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\View\View;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SiteStoreRequest;
use App\Http\Requests\SiteUpdateRequest;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Site::class);

        $search = $request->get('search', '');

        $sites = Site::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.sites.index', compact('sites', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Site::class);

        $entreprises = Entreprise::pluck('raison_sociale', 'id');

        return view('app.sites.create', compact('entreprises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiteStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Site::class);

        $validated = $request->validated();

        $site = Site::create($validated);

        return redirect()
            ->route('sites.edit', $site)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Site $site): View
    {
        $this->authorize('view', $site);

        return view('app.sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Site $site): View
    {
        $this->authorize('update', $site);

        $entreprises = Entreprise::pluck('raison_sociale', 'id');

        return view('app.sites.edit', compact('site', 'entreprises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SiteUpdateRequest $request,
        Site $site
    ): RedirectResponse {
        $this->authorize('update', $site);

        $validated = $request->validated();

        $site->update($validated);

        return redirect()
            ->route('sites.edit', $site)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Site $site): RedirectResponse
    {
        $this->authorize('delete', $site);

        $site->delete();

        return redirect()
            ->route('sites.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
