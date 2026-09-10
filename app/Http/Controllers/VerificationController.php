<?php

namespace App\Http\Controllers;

use App\Models\Card;

class VerificationController extends Controller
{
    public function show(string $qr_token)
    {
        $card = Card::with([
            'member.category',
            'member.federation',
        ])
        ->where('qr_token', $qr_token)
        ->first();

        if (!$card) {
            return view('verification.invalid');
        }

        return view('verification.show', compact('card'));
    }
}
