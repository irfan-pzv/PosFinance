<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'units';

    protected $fillable = [
        'code',
        'name',
        'description',
        'category',
        'person_in_charge',
        'status',
    ];

    // Get the financial records for the unit.
    public function finances(): HasMany
    {
        return $this->hasMany(Finance::class, 'unit_id');
    }
}
