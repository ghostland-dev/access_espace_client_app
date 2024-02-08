<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Historique;
use App\Models\Entreprise;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserHistoriquesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public User $user;
    public Historique $historique;
    public $entreprisesForSelect = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Historique';

    protected $rules = [
        'historique.entreprise_id' => ['required', 'exists:entreprises,id'],
        'historique.action' => ['required', 'max:255', 'string'],
        'historique.type' => ['required', 'max:255', 'string'],
    ];

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->entreprisesForSelect = Entreprise::pluck('raison_sociale', 'id');
        $this->resetHistoriqueData();
    }

    public function resetHistoriqueData(): void
    {
        $this->historique = new Historique();

        $this->historique->entreprise_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newHistorique(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.user_historiques.new_title');
        $this->resetHistoriqueData();

        $this->showModal();
    }

    public function editHistorique(Historique $historique): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.user_historiques.edit_title');
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

        if (!$this->historique->user_id) {
            $this->authorize('create', Historique::class);

            $this->historique->user_id = $this->user->id;
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

        foreach ($this->user->historiques as $historique) {
            array_push($this->selected, $historique->id);
        }
    }

    public function render(): View
    {
        return view('livewire.user-historiques-detail', [
            'historiques' => $this->user->historiques()->paginate(20),
        ]);
    }
}
