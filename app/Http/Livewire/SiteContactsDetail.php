<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Livewire\Component;
use App\Models\Contact;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SiteContactsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Site $site;
    public Contact $contact;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Contact';

    protected $rules = [
        'contact.civilite' => ['required', 'max:255', 'string'],
        'contact.nom' => ['required', 'max:255', 'string'],
        'contact.prenom' => ['required', 'max:255', 'string'],
        'contact.fonction' => ['required', 'max:255', 'string'],
        'contact.mobile' => ['required', 'max:255', 'string'],
        'contact.fix' => ['required', 'max:255', 'string'],
        'contact.signataire' => ['required', 'boolean'],
        'contact.decisionnaire' => ['required', 'boolean'],
    ];

    public function mount(Site $site): void
    {
        $this->site = $site;
        $this->resetContactData();
    }

    public function resetContactData(): void
    {
        $this->contact = new Contact();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newContact(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.site_contacts.new_title');
        $this->resetContactData();

        $this->showModal();
    }

    public function editContact(Contact $contact): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.site_contacts.edit_title');
        $this->contact = $contact;

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

        if (!$this->contact->site_id) {
            $this->authorize('create', Contact::class);

            $this->contact->site_id = $this->site->id;
        } else {
            $this->authorize('update', $this->contact);
        }

        $this->contact->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Contact::class);

        Contact::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetContactData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->site->contacts as $contact) {
            array_push($this->selected, $contact->id);
        }
    }

    public function render(): View
    {
        return view('livewire.site-contacts-detail', [
            'contacts' => $this->site->contacts()->paginate(20),
        ]);
    }
}
