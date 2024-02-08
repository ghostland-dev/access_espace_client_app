<?php

namespace App\Http\Livewire;

use App\Models\Score;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Entreprise;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EntrepriseScoresDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Entreprise $entreprise;
    public Score $score;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Score';

    protected $rules = [
        'score.creditsafe' => ['required', 'numeric'],
        'score.elipro' => ['required', 'numeric'],
    ];

    public function mount(Entreprise $entreprise): void
    {
        $this->entreprise = $entreprise;
        $this->resetScoreData();
    }

    public function resetScoreData(): void
    {
        $this->score = new Score();

        $this->dispatchBrowserEvent('refresh');
    }

    public function newScore(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.entreprise_scores.new_title');
        $this->resetScoreData();

        $this->showModal();
    }

    public function editScore(Score $score): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.entreprise_scores.edit_title');
        $this->score = $score;

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

        if (!$this->score->entreprise_id) {
            $this->authorize('create', Score::class);

            $this->score->entreprise_id = $this->entreprise->id;
        } else {
            $this->authorize('update', $this->score);
        }

        $this->score->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Score::class);

        Score::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetScoreData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->entreprise->scores as $score) {
            array_push($this->selected, $score->id);
        }
    }

    public function render(): View
    {
        return view('livewire.entreprise-scores-detail', [
            'scores' => $this->entreprise->scores()->paginate(20),
        ]);
    }
}
