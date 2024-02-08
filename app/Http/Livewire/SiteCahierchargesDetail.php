<?php

namespace App\Http\Livewire;

use App\Models\Site;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithPagination;
use App\Models\Cahiercharge;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SiteCahierchargesDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Site $site;
    public Cahiercharge $cahiercharge;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Cahiercharge';

    protected $rules = [
        'cahiercharge.duree_contrat' => [
            'required',
            'in:sans engagement,12 mois,24 mois,36 mois',
        ],
        'cahiercharge.energie_verte' => ['required', 'in:oui,non'],
        'cahiercharge.encouter_les_opportunites' => ['required', 'boolean'],
        'cahiercharge.frequence_facturation' => [
            'required',
            'in:mensuelle,biimensuelle,trimensuelle,annuelle',
        ],
        'cahiercharge.type_offre' => [
            'required',
            'in:prix fix 100% marché,prix indexé arenh',
        ],
        'cahiercharge.mode_paiement' => [
            'required',
            'in:prélevement bancaire,virement bancaire,chéque,carte banciare',
        ],
        'cahiercharge.offre_fournisseur' => [
            'required',
            'in:offre à titre indicative,offre réel et fermé',
        ],
    ];

    public function mount(Site $site): void
    {
        $this->site = $site;
        $this->resetCahierchargeData();
    }

    public function resetCahierchargeData(): void
    {
        $this->cahiercharge = new Cahiercharge();

        $this->cahiercharge->duree_contrat = 'Sans Engagement';
        $this->cahiercharge->energie_verte = 'Oui';
        $this->cahiercharge->frequence_facturation = 'Mensuelle';
        $this->cahiercharge->type_offre = 'Prix fix 100% marché';
        $this->cahiercharge->mode_paiement = 'Prélevement Bancaire';
        $this->cahiercharge->offre_fournisseur = 'Offre à titre indicative';

        $this->dispatchBrowserEvent('refresh');
    }

    public function newCahiercharge(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.site_cahiercharges.new_title');
        $this->resetCahierchargeData();

        $this->showModal();
    }

    public function editCahiercharge(Cahiercharge $cahiercharge): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.site_cahiercharges.edit_title');
        $this->cahiercharge = $cahiercharge;

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

        if (!$this->cahiercharge->site_id) {
            $this->authorize('create', Cahiercharge::class);

            $this->cahiercharge->site_id = $this->site->id;
        } else {
            $this->authorize('update', $this->cahiercharge);
        }

        $this->cahiercharge->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Cahiercharge::class);

        Cahiercharge::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetCahierchargeData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->site->cahiercharges as $cahiercharge) {
            array_push($this->selected, $cahiercharge->id);
        }
    }

    public function render(): View
    {
        return view('livewire.site-cahiercharges-detail', [
            'cahiercharges' => $this->site->cahiercharges()->paginate(20),
        ]);
    }
}
