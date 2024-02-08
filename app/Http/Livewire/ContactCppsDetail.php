<?php

namespace App\Http\Livewire;

use App\Models\Cpp;
use Livewire\Component;
use App\Models\Contact;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactCppsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Contact $contact;
    public Cpp $cpp;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Cpp';

    protected $rules = [
        'cpp.fichier' => ['required', 'max:255', 'string'],
        'cpp.signe' => ['required', 'boolean'],
    ];

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
        $this->resetCppData();
    }

    public function resetCppData(): void
    {
        $this->cpp = new Cpp();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCpp(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.contact_cpps.new_title');
        $this->resetCppData();

        $this->showModal();
    }

    public function editCpp(Cpp $cpp): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.contact_cpps.edit_title');
        $this->cpp = $cpp;

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

        if (!$this->cpp->contact_id) {
            $this->authorize('create', Cpp::class);

            $this->cpp->contact_id = $this->contact->id;
        } else {
            $this->authorize('update', $this->cpp);
        }

        $this->cpp->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Cpp::class);

        Cpp::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCppData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->contact->cpps as $cpp) {
            array_push($this->selected, $cpp->id);
        }
    }

    public function render(): View
    {
        return view('livewire.contact-cpps-detail', [
            'cpps' => $this->contact->cpps()->paginate(20),
        ]);
    }
}
