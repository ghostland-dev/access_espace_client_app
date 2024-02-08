<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['creditsafe', 'elipro', 'entreprise_id'];

    protected $searchableFields = ['*'];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }
}
