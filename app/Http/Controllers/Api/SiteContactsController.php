<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;

class SiteContactsController extends Controller
{
    public function index(Request $request, Site $site): ContactCollection
    {
        $this->authorize('view', $site);

        $search = $request->get('search', '');

        $contacts = $site
            ->contacts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContactCollection($contacts);
    }

    public function store(Request $request, Site $site): ContactResource
    {
        $this->authorize('create', Contact::class);

        $validated = $request->validate([
            'civilite' => ['required', 'max:255', 'string'],
            'nom' => ['required', 'max:255', 'string'],
            'prenom' => ['required', 'max:255', 'string'],
            'fonction' => ['required', 'max:255', 'string'],
            'mobile' => ['required', 'max:255', 'string'],
            'fix' => ['required', 'max:255', 'string'],
            'signataire' => ['required', 'boolean'],
            'decisionnaire' => ['required', 'boolean'],
        ]);

        $contact = $site->contacts()->create($validated);

        return new ContactResource($contact);
    }
}
