<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entreprise extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'raison_sociale',
        'siren',
        'siret',
        'ville',
        'code_postal',
        'adresse',
        'details',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function historiques()
    {
        return $this->hasMany(Historique::class);
    }
}
