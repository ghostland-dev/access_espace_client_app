<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Http\Resources\ContactCollection;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;

class ContactController extends Controller
{
    public function index(Request $request): ContactCollection
    {
        $this->authorize('view-any', Contact::class);

        $search = $request->get('search', '');

        $contacts = Contact::search($search)
            ->latest()
            ->paginate();

        return new ContactCollection($contacts);
    }

    public function store(ContactStoreRequest $request): ContactResource
    {
        $this->authorize('create', Contact::class);

        $validated = $request->validated();

        $contact = Contact::create($validated);

        return new ContactResource($contact);
    }

    public function show(Request $request, Contact $contact): ContactResource
    {
        $this->authorize('view', $contact);

        return new ContactResource($contact);
    }

    public function update(
        ContactUpdateRequest $request,
        Contact $contact
    ): ContactResource {
        $this->authorize('update', $contact);

        $validated = $request->validated();

        $contact->update($validated);

        return new ContactResource($contact);
    }

    public function destroy(Request $request, Contact $contact): Response
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return response()->noContent();
    }
}
