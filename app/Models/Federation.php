<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Federation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'sigle',
        'description',
        'active',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
