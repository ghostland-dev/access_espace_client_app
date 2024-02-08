<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Entreprise;
use App\Models\Historique;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EntrepriseHistoriquesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Entreprise $entreprise;
    public Historique $historique;
    public $usersForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Historique';

    protected $rules = [
        'historique.user_id' => ['required', 'exists:users,id'],
        'historique.action' => ['required', 'max:255', 'string'],
        'historique.type' => ['required', 'max:255', 'string'],
    ];

    public function mount(Entreprise $entreprise): void
    {
        $this->entreprise = $entreprise;
        $this->usersForSelect = User::pluck('name', 'id');
        $this->resetHistoriqueData();
    }

    public function resetHistoriqueData(): void
    {
        $this->historique = new Historique();

        $this->historique->user_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newHistorique(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.entreprise_historiques.new_title');
        $this->resetHistoriqueData();

        $this->showModal();
    }

    public function editHistorique(Historique $historique): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.entreprise_historiques.edit_title');
        $this->historique = $historique;

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

        if (!$this->historique->entreprise_id) {
            $this->authorize('create', Historique::class);

            $this->historique->entreprise_id = $this->entreprise->id;
        } else {
            $this->authorize('update', $this->historique);
        }

        $this->historique->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Historique::class);

        Historique::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetHistoriqueData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->entreprise->historiques as $historique) {
            array_push($this->selected, $historique->id);
        }
    }

    public function render(): View
    {
        return view('livewire.entreprise-historiques-detail', [
            'historiques' => $this->entreprise->historiques()->paginate(20),
        ]);
    }
}
