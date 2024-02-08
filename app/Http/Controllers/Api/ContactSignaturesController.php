<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SignatureResource;
use App\Http\Resources\SignatureCollection;

class ContactSignaturesController extends Controller
{
    public function index(
        Request $request,
        Contact $contact
    ): SignatureCollection {
        $this->authorize('view', $contact);

        $search = $request->get('search', '');

        $signatures = $contact
            ->signatures()
            ->search($search)
            ->latest()
            ->paginate();

        return new SignatureCollection($signatures);
    }

    public function store(Request $request, Contact $contact): SignatureResource
    {
        $this->authorize('create', Signature::class);

        $validated = $request->validate([
            'fichier' => ['required', 'max:255', 'string'],
            'signe' => ['required', 'boolean'],
        ]);

        $signature = $contact->signatures()->create($validated);

        return new SignatureResource($signature);
    }
}
