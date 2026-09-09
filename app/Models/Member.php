<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_membre',
        'nom',
        'postnom',
        'prenom',
        'date_naissance',
        'sexe',
        'lieu_naissance',
        'nationalite',
        'telephone',
        'email',
        'domicile',
        'profession_artistique',
        'category_id',
        'federation_id',
        'photo',
        'date_adhesion',
        'statut',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_adhesion' => 'date',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function federation(): BelongsTo
    {
        return $this->belongsTo(Federation::class);
    }

    public function card(): HasOne
    {
        return $this->hasOne(Card::class);
    }
}
