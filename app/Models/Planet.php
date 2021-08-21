<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'diameter',
        'rotation_period',
        'gravity',
        'population',
        'climate',
        'terrain',
        'surface_water',
        'films',
        'url',
    ];

    protected $casts = [
        'films' => 'array'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function peoples()
    {
        return $this->hasMany(People::class);
    }
}
