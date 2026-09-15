<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $fillable = [
        'member_id',
        'numero_carte',
        'qr_token',
        'date_delivrance',
        'date_expiration',
        'statut',
        'statut_production',
        'remise',
        'date_remise',
    ];

    protected $casts = [
        'date_delivrance' => 'date',
        'date_expiration' => 'date',
        'date_remise' => 'date',
        'remise' => 'boolean',
    ];

    /**
     * Membre propriétaire de la carte
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
