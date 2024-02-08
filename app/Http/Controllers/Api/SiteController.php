<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\SiteResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SiteCollection;
use App\Http\Requests\SiteStoreRequest;
use App\Http\Requests\SiteUpdateRequest;

class SiteController extends Controller
{
    public function index(Request $request): SiteCollection
    {
        $this->authorize('view-any', Site::class);

        $search = $request->get('search', '');

        $sites = Site::search($search)
            ->latest()
            ->paginate();

        return new SiteCollection($sites);
    }

    public function store(SiteStoreRequest $request): SiteResource
    {
        $this->authorize('create', Site::class);

        $validated = $request->validated();

        $site = Site::create($validated);

        return new SiteResource($site);
    }

    public function show(Request $request, Site $site): SiteResource
    {
        $this->authorize('view', $site);

        return new SiteResource($site);
    }

    public function update(SiteUpdateRequest $request, Site $site): SiteResource
    {
        $this->authorize('update', $site);

        $validated = $request->validated();

        $site->update($validated);

        return new SiteResource($site);
    }

    public function destroy(Request $request, Site $site): Response
    {
        $this->authorize('delete', $site);

        $site->delete();

        return response()->noContent();
    }
}
