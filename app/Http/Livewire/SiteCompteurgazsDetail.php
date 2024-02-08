<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Compteurgaz;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SiteCompteurgazsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Site $site;
    public Compteurgaz $compteurgaz;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Compteurgaz';

    protected $rules = [
        'compteurgaz.PCE' => ['required', 'max:255', 'string'],
    ];

    public function mount(Site $site): void
    {
        $this->site = $site;
        $this->resetCompteurgazData();
    }

    public function resetCompteurgazData(): void
    {
        $this->compteurgaz = new Compteurgaz();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCompteurgaz(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.site_compteurgazs.new_title');
        $this->resetCompteurgazData();

        $this->showModal();
    }

    public function editCompteurgaz(Compteurgaz $compteurgaz): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.site_compteurgazs.edit_title');
        $this->compteurgaz = $compteurgaz;

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

        if (!$this->compteurgaz->site_id) {
            $this->authorize('create', Compteurgaz::class);

            $this->compteurgaz->site_id = $this->site->id;
        } else {
            $this->authorize('update', $this->compteurgaz);
        }

        $this->compteurgaz->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Compteurgaz::class);

        Compteurgaz::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCompteurgazData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->site->compteurgazs as $compteurgaz) {
            array_push($this->selected, $compteurgaz->id);
        }
    }

    public function render(): View
    {
        return view('livewire.site-compteurgazs-detail', [
            'compteurgazs' => $this->site->compteurgazs()->paginate(20),
        ]);
    }
}
