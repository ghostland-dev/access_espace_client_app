<?php

namespace App\Http\Controllers;

use App\Models\Cpp;
use App\Models\Contact;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CppStoreRequest;
use App\Http\Requests\CppUpdateRequest;

class CppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Cpp::class);

        $search = $request->get('search', '');

        $cpps = Cpp::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.cpps.index', compact('cpps', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Cpp::class);

        $contacts = Contact::pluck('civilite', 'id');

        return view('app.cpps.create', compact('contacts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CppStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Cpp::class);

        $validated = $request->validated();

        $cpp = Cpp::create($validated);

        return redirect()
            ->route('cpps.edit', $cpp)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Cpp $cpp): View
    {
        $this->authorize('view', $cpp);

        return view('app.cpps.show', compact('cpp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Cpp $cpp): View
    {
        $this->authorize('update', $cpp);

        $contacts = Contact::pluck('civilite', 'id');

        return view('app.cpps.edit', compact('cpp', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CppUpdateRequest $request,
        Cpp $cpp
    ): RedirectResponse {
        $this->authorize('update', $cpp);

        $validated = $request->validated();

        $cpp->update($validated);

        return redirect()
            ->route('cpps.edit', $cpp)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Cpp $cpp): RedirectResponse
    {
        $this->authorize('delete', $cpp);

        $cpp->delete();

        return redirect()
            ->route('cpps.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
