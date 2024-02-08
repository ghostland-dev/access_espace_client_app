<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\Compteurelec;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SiteCompteurelecsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Site $site;
    public Compteurelec $compteurelec;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Compteurelec';

    protected $rules = [
        'compteurelec.PDL' => ['required', 'max:255', 'string'],
    ];

    public function mount(Site $site): void
    {
        $this->site = $site;
        $this->resetCompteurelecData();
    }

    public function resetCompteurelecData(): void
    {
        $this->compteurelec = new Compteurelec();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCompteurelec(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.site_compteurelecs.new_title');
        $this->resetCompteurelecData();

        $this->showModal();
    }

    public function editCompteurelec(Compteurelec $compteurelec): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.site_compteurelecs.edit_title');
        $this->compteurelec = $compteurelec;

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

        if (!$this->compteurelec->site_id) {
            $this->authorize('create', Compteurelec::class);

            $this->compteurelec->site_id = $this->site->id;
        } else {
            $this->authorize('update', $this->compteurelec);
        }

        $this->compteurelec->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Compteurelec::class);

        Compteurelec::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCompteurelecData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->site->compteurelecs as $compteurelec) {
            array_push($this->selected, $compteurelec->id);
        }
    }

    public function render(): View
    {
        return view('livewire.site-compteurelecs-detail', [
            'compteurelecs' => $this->site->compteurelecs()->paginate(20),
        ]);
    }
}
