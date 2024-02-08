<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Entreprise;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserEntreprisesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Entreprise $entreprise;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Entreprise';

    protected $rules = [
        'entreprise.raison_sociale' => ['nullable', 'max:255', 'string'],
        'entreprise.siren' => ['nullable', 'max:255', 'string'],
        'entreprise.siret' => ['nullable', 'max:255', 'string'],
        'entreprise.ville' => ['required', 'max:255', 'string'],
        'entreprise.code_postal' => ['required', 'max:255', 'string'],
        'entreprise.adresse' => ['required', 'max:255', 'string'],
        'entreprise.details' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->resetEntrepriseData();
    }

    public function resetEntrepriseData(): void
    {
        $this->entreprise = new Entreprise();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newEntreprise(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_entreprises.new_title');
        $this->resetEntrepriseData();

        $this->showModal();
    }

    public function editEntreprise(Entreprise $entreprise): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_entreprises.edit_title');
        $this->entreprise = $entreprise;

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

        if (!$this->entreprise->user_id) {
            $this->authorize('create', Entreprise::class);

            $this->entreprise->user_id = $this->user->id;
        } else {
            $this->authorize('update', $this->entreprise);
        }

        $this->entreprise->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Entreprise::class);

        Entreprise::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEntrepriseData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->user->entreprises as $entreprise) {
            array_push($this->selected, $entreprise->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-entreprises-detail', [
            'entreprises' => $this->user->entreprises()->paginate(20),
        ]);
    }
}
