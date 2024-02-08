<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compteurelec extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['PDL', 'site_id'];

    protected $searchableFields = ['*'];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
