<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'numero_carte',
        'qr_token',
        'date_delivrance',
        'date_expiration',
        'statut',

        // Production
        'statut_production',

        // Remise à l'UNEAC
        'remise_uneac',
        'date_remise_uneac',

        // Remise à l'artiste
        'remise_artiste',
        'date_remise_artiste',
    ];

    protected $casts = [
        'date_delivrance' => 'date',
        'date_expiration' => 'date',

        'remise_uneac' => 'boolean',
        'date_remise_uneac' => 'date',

        'remise_artiste' => 'boolean',
        'date_remise_artiste' => 'date',
    ];

    /**
     * Membre auquel appartient la carte.
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
