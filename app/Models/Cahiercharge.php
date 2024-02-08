<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cahiercharge extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'site_id',
        'duree_contrat',
        'energie_verte',
        'encouter_les_opportunites',
        'frequence_facturation',
        'type_offre',
        'mode_paiement',
        'offre_fournisseur',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'encouter_les_opportunites' => 'boolean',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
