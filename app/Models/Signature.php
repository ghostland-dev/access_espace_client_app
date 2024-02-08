<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Signature extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['fichier', 'signe', 'contact_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'signe' => 'boolean',
    ];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
