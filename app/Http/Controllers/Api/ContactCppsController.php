<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Resources\CppResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CppCollection;

class ContactCppsController extends Controller
{
    public function index(Request $request, Contact $contact): CppCollection
    {
        $this->authorize('view', $contact);

        $search = $request->get('search', '');

        $cpps = $contact
            ->cpps()
            ->search($search)
            ->latest()
            ->paginate();

        return new CppCollection($cpps);
    }

    public function store(Request $request, Contact $contact): CppResource
    {
        $this->authorize('create', Cpp::class);

        $validated = $request->validate([
            'fichier' => ['required', 'max:255', 'string'],
            'signe' => ['required', 'boolean'],
        ]);

        $cpp = $contact->cpps()->create($validated);

        return new CppResource($cpp);
    }
}
