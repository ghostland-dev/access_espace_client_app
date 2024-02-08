<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\View\View;
use App\Models\Signature;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactSignaturesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Contact $contact;
    public Signature $signature;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Signature';

    protected $rules = [
        'signature.fichier' => ['required', 'max:255', 'string'],
        'signature.signe' => ['required', 'boolean'],
    ];

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
        $this->resetSignatureData();
    }

    public function resetSignatureData(): void
    {
        $this->signature = new Signature();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSignature(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.contact_signatures.new_title');
        $this->resetSignatureData();

        $this->showModal();
    }

    public function editSignature(Signature $signature): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.contact_signatures.edit_title');
        $this->signature = $signature;

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->signature->contact_id) {
            $this->authorize('create', Signature::class);

            $this->signature->contact_id = $this->contact->id;
        } else {
            $this->authorize('update', $this->signature);
        }

        $this->signature->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Signature::class);

        Signature::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSignatureData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->contact->signatures as $signature) {
            array_push($this->selected, $signature->id);
        }
    }

    public function render(): View
    {
        return view('livewire.contact-signatures-detail', [
            'signatures' => $this->contact->signatures()->paginate(20),
        ]);
    }
}
