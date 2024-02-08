<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Entreprise;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EntrepriseSitesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Entreprise $entreprise;
    public Site $site;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Site';

    protected $rules = [
        'site.siret' => ['required', 'max:255', 'string'],
        'site.ville' => ['required', 'max:255', 'string'],
        'site.code_postal' => ['required', 'max:255', 'string'],
        'site.adresse' => ['required', 'max:255', 'string'],
    ];

    public function mount(Entreprise $entreprise): void
    {
        $this->entreprise = $entreprise;
        $this->resetSiteData();
    }

    public function resetSiteData(): void
    {
        $this->site = new Site();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newSite(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.entreprise_sites.new_title');
        $this->resetSiteData();

        $this->showModal();
    }

    public function editSite(Site $site): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.entreprise_sites.edit_title');
        $this->site = $site;

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

        if (!$this->site->entreprise_id) {
            $this->authorize('create', Site::class);

            $this->site->entreprise_id = $this->entreprise->id;
        } else {
            $this->authorize('update', $this->site);
        }

        $this->site->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Site::class);

        Site::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetSiteData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->entreprise->sites as $site) {
            array_push($this->selected, $site->id);
        }
    }

    public function render(): View
    {
        return view('livewire.entreprise-sites-detail', [
            'sites' => $this->entreprise->sites()->paginate(20),
        ]);
    }
}
