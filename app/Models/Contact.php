<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'civilite',
        'nom',
        'prenom',
        'fonction',
        'mobile',
        'fix',
        'signataire',
        'decisionnaire',
        'site_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'signataire' => 'boolean',
        'decisionnaire' => 'boolean',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function cpps()
    {
        return $this->hasMany(Cpp::class);
    }

    public function signatures()
    {
        return $this->hasMany(Signature::class);
    }
}
