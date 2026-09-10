<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CardController extends Controller
{
    /**
     * Liste des cartes
     */
    public function index(Request $request)
    {
        $query = Card::with([
            'member.category',
            'member.federation'
        ]);

        // Recherche
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('numero_carte', 'like', "%{$search}%")
                    ->orWhere('qr_token', 'like', "%{$search}%")
                    ->orWhereHas('member', function ($memberQuery) use ($search) {

                        $memberQuery->where('numero_membre', 'like', "%{$search}%")
                            ->orWhere('nom', 'like', "%{$search}%")
                            ->orWhere('postnom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");
                    });
            });
        }

        // Filtre statut
        if ($request->filled('status')) {
            $query->where('statut', $request->status);
        }

        $cards = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('cards.index', compact('cards'));
    }


    /**
     * Création
     * La création se fera depuis le modal.
     */
    public function create()
    {
        return redirect()->route('cards.index');
    }


    /**
     * Enregistrer une carte
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => [
                'required',
                'exists:members,id',
                'unique:cards,member_id',
            ],

            'date_delivrance' => [
                'required',
                'date',
            ],

            'date_expiration' => [
                'required',
                'date',
                'after:date_delivrance',
            ],

            'statut' => [
                'required',
                'in:active,expiree,suspendue,revoquee',
            ],
        ]);


        // Vérification supplémentaire
        if (Card::where('member_id', $validated['member_id'])->exists()) {

            return back()
                ->withInput()
                ->withErrors([
                    'member_id' => 'Ce membre possède déjà une carte.'
                ]);
        }


        // Dernière carte
        $lastCard = Card::latest('id')->first();

        $nextNumber = $lastCard
            ? $lastCard->id + 1
            : 1;


        // Numéro de carte automatique
        $validated['numero_carte'] =
            'UNEAC-C-' . str_pad(
                $nextNumber,
                5,
                '0',
                STR_PAD_LEFT
            );


        // Token QR unique
        do {

            $qrToken = Str::random(40);
        } while (Card::where('qr_token', $qrToken)->exists());


        $validated['qr_token'] = $qrToken;


        Card::create($validated);


        return redirect()
            ->route('cards.index')
            ->with('success', 'Carte créée avec succès.');
    }


    /**
     * Afficher une carte
     */
    public function show(Card $card)
    {
        $card->load([
            'member.category',
            'member.federation'
        ]);

        return view(
            'cards.modals.show',
            compact('card')
        );
    }


    /**
     * Modifier une carte
     */
    public function edit(Card $card)
    {
        $card->load('member');

        return view(
            'cards.modals.edit',
            compact('card')
        );
    }


    /**
     * Mettre à jour une carte
     */
    public function update(Request $request, Card $card)
    {
        $validated = $request->validate([
            'date_delivrance' => [
                'required',
                'date',
            ],

            'date_expiration' => [
                'required',
                'date',
                'after:date_delivrance',
            ],

            'statut' => [
                'required',
                'in:active,expiree,suspendue,revoquee',
            ],
        ]);


        $card->update($validated);


        return redirect()
            ->route('cards.index')
            ->with('success', 'Carte mise à jour avec succès.');
    }

    public function preview(Card $card)
    {
        $card->load([
            'member.category',
            'member.federation',
        ]);

        return view('cards.preview', compact('card'));
    }


    /**
     * Supprimer une carte
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return redirect()
            ->route('cards.index')
            ->with('success', 'Carte supprimée avec succès.');
    }
}
