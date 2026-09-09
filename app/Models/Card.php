<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    ];

    protected $casts = [
        'date_delivrance' => 'date',
        'date_expiration' => 'date',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
