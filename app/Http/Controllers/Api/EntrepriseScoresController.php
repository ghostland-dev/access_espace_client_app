<?php

namespace App\Http\Controllers\Api;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ScoreResource;
use App\Http\Resources\ScoreCollection;

class EntrepriseScoresController extends Controller
{
    public function index(
        Request $request,
        Entreprise $entreprise
    ): ScoreCollection {
        $this->authorize('view', $entreprise);

        $search = $request->get('search', '');

        $scores = $entreprise
            ->scores()
            ->search($search)
            ->latest()
            ->paginate();

        return new ScoreCollection($scores);
    }

    public function store(
        Request $request,
        Entreprise $entreprise
    ): ScoreResource {
        $this->authorize('create', Score::class);

        $validated = $request->validate([
            'creditsafe' => ['required', 'numeric'],
            'elipro' => ['required', 'numeric'],
        ]);

        $score = $entreprise->scores()->create($validated);

        return new ScoreResource($score);
    }
}
