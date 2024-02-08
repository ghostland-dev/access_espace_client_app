<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Site extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'siret',
        'ville',
        'code_postal',
        'adresse',
        'entreprise_id',
    ];

    protected $searchableFields = ['*'];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function compteurelecs()
    {
        return $this->hasMany(Compteurelec::class);
    }

    public function compteurgazs()
    {
        return $this->hasMany(Compteurgaz::class);
    }

    public function cahiercharges()
    {
        return $this->hasMany(Cahiercharge::class);
    }
}
