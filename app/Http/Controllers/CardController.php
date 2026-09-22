<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Member;
use App\Models\Federation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CardController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LISTE DES CARTES
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Card::with([
            'member.category',
            'member.federation',
        ]);

        /*
        |--------------------------------------------------------------------------
        | RECHERCHE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('numero_carte', 'like', "%{$search}%")

                    ->orWhereHas('member', function ($member) use ($search) {

                        $member->where('numero_membre', 'like', "%{$search}%")
                            ->orWhere('nom', 'like', "%{$search}%")
                            ->orWhere('postnom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");

                    });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | STATUT
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'statut',
                $request->status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PRODUCTION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('production')) {

            $query->where(
                'statut_production',
                $request->production
            );

        }


        /*
        |--------------------------------------------------------------------------
        | REMISE UNEAC
        |--------------------------------------------------------------------------
        */

        if ($request->filled('remise_uneac')) {

            $query->where(
                'remise_uneac',
                $request->remise_uneac
            );

        }


        /*
        |--------------------------------------------------------------------------
        | REMISE ARTISTE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('remise_artiste')) {

            $query->where(
                'remise_artiste',
                $request->remise_artiste
            );

        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $cards = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | MEMBRES DISPONIBLES POUR CRÉER UNE CARTE
        |--------------------------------------------------------------------------
        */

        $members = Member::with([
            'category',
            'federation',
        ])
            ->whereDoesntHave('card')
            ->where('statut', 'actif')
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();


        return view(
            'cards.index',
            compact(
                'cards',
                'members'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULAIRE DE CRÉATION
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $members = Member::with([
            'category',
            'federation',
        ])
        ->whereDoesntHave('card')
        ->where('statut', 'actif')
        ->orderBy('nom')
        ->orderBy('prenom')
        ->get();


        return view('cards.create', compact('members'));
    }


    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER UNE CARTE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'member_id' => [
                'required',
                'exists:members,id',
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

        ]);


        /*
        |--------------------------------------------------------------------------
        | VÉRIFIER SI LE MEMBRE A DÉJÀ UNE CARTE
        |--------------------------------------------------------------------------
        */

        $existingCard = Card::where(
            'member_id',
            $validated['member_id']
        )->first();


        if ($existingCard) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce membre possède déjà une carte.'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | GÉNÉRER LE NUMÉRO DE CARTE
        |--------------------------------------------------------------------------
        */

        $lastCard = Card::latest('id')->first();

        $nextNumber = $lastCard
            ? $lastCard->id + 1
            : 1;


        $numeroCarte =
            'UNEAC-CG-26-' .
            str_pad(
                $nextNumber,
                5,
                '0',
                STR_PAD_LEFT
            );


        /*
        |--------------------------------------------------------------------------
        | GÉNÉRER LE TOKEN QR
        |--------------------------------------------------------------------------
        */

        do {

            $qrToken = Str::random(64);

        } while (
            Card::where('qr_token', $qrToken)->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | CRÉATION
        |--------------------------------------------------------------------------
        */

        $card = Card::create([

            'member_id' => $validated['member_id'],

            'numero_carte' => $numeroCarte,

            'qr_token' => $qrToken,

            'date_delivrance' =>
                $validated['date_delivrance'],

            'date_expiration' =>
                $validated['date_expiration'],

            'statut' => 'active',

            /*
            | Carte pas encore imprimée
            */

            'statut_production' => 'en_attente',

            /*
            | Pas encore remise à l'UNEAC
            */

            'remise_uneac' => false,

            'date_remise_uneac' => null,

            /*
            | Pas encore remise au membre
            */

            'remise_artiste' => false,

            'date_remise_artiste' => null,

        ]);


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'Carte créée avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | AFFICHER UNE CARTE
    |--------------------------------------------------------------------------
    */

    public function show(Card $card)
    {
        $card->load([
            'member.category',
            'member.federation',
        ]);


        return view(
            'cards.show',
            compact('card')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FORMULAIRE MODIFICATION
    |--------------------------------------------------------------------------
    */

    public function edit(Card $card)
    {
        $members = Member::with([
            'category',
            'federation',
        ])
        ->where(function ($query) use ($card) {

            $query->whereDoesntHave('card')
                ->orWhere('id', $card->member_id);

        })
        ->orderBy('nom')
        ->orderBy('prenom')
        ->get();


        return view(
            'cards.edit',
            compact(
                'card',
                'members'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | MODIFIER UNE CARTE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Card $card
    ) {

        $validated = $request->validate([

            'member_id' => [
                'required',
                'exists:members,id',
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


        /*
        |--------------------------------------------------------------------------
        | VÉRIFIER LE MEMBRE
        |--------------------------------------------------------------------------
        */

        $existingCard = Card::where(
            'member_id',
            $validated['member_id']
        )
        ->where(
            'id',
            '!=',
            $card->id
        )
        ->exists();


        if ($existingCard) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce membre possède déjà une autre carte.'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | MISE À JOUR
        |--------------------------------------------------------------------------
        */

        $card->update([

            'member_id' =>
                $validated['member_id'],

            'date_delivrance' =>
                $validated['date_delivrance'],

            'date_expiration' =>
                $validated['date_expiration'],

            'statut' =>
                $validated['statut'],

        ]);


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'Carte modifiée avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SUPPRIMER
    |--------------------------------------------------------------------------
    */

    public function destroy(Card $card)
    {
        $card->delete();


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'Carte supprimée avec succès.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PRÉVISUALISATION
    |--------------------------------------------------------------------------
    */

    public function preview(Card $card)
    {
        $card->load([
            'member.category',
            'member.federation',
        ]);


        return view(
            'cards.preview',
            compact('card')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PRODUIRE / IMPRIMER LA CARTE
    |--------------------------------------------------------------------------
    |
    | Cette action signifie :
    | La carte a physiquement été imprimée.
    |
    */

    public function produire(Card $card)
    {
        /*
        |--------------------------------------------------------------------------
        | Vérifier le statut
        |--------------------------------------------------------------------------
        */

        if ($card->statut_production === 'produite') {

            return back()->with(
                'error',
                'Cette carte est déjà marquée comme produite.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Vérifier le statut de la carte
        |--------------------------------------------------------------------------
        */

        if ($card->statut !== 'active') {

            return back()->with(
                'error',
                'Une carte inactive ne peut pas être produite.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Marquer comme produite
        |--------------------------------------------------------------------------
        */

        $card->update([

            'statut_production' => 'produite',

        ]);


        return back()->with(
            'success',
            'La carte a été marquée comme produite.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE RÉCEPTION DES CARTES PAR L'UNEAC
    |--------------------------------------------------------------------------
    */

    public function reception(Request $request)
    {
        $query = Card::with([
            'member.category',
            'member.federation',
        ])
        ->where(
            'statut_production',
            'produite'
        )
        ->where(
            'remise_uneac',
            false
        );


        /*
        |--------------------------------------------------------------------------
        | RECHERCHE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'numero_carte',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'member',
                    function ($member) use ($search) {

                        $member
                            ->where(
                                'numero_membre',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'nom',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'postnom',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'prenom',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'telephone',
                                'like',
                                "%{$search}%"
                            );

                    }
                );

            });

        }


        /*
        |--------------------------------------------------------------------------
        | FÉDÉRATION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('federation_id')) {

            $query->whereHas(
                'member',
                function ($member) use ($request) {

                    $member->where(
                        'federation_id',
                        $request->federation_id
                    );

                }
            );

        }


        $cards = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        $federations = Federation::orderBy('nom')
            ->get();


        return view(
            'cards.reception',
            compact(
                'cards',
                'federations'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER LA RÉCEPTION PAR L'UNEAC
    |--------------------------------------------------------------------------
    |
    | L'utilisateur sélectionne plusieurs cartes.
    |
    */

    public function storeReception(Request $request)
    {
        $validated = $request->validate([

            'cards' => [
                'required',
                'array',
                'min:1',
            ],

            'cards.*' => [
                'integer',
                'exists:cards,id',
            ],

        ]);


        $cards = Card::whereIn(
            'id',
            $validated['cards']
        )
        ->where(
            'statut_production',
            'produite'
        )
        ->where(
            'remise_uneac',
            false
        )
        ->get();


        if ($cards->isEmpty()) {

            return back()->with(
                'error',
                'Aucune carte valide à réceptionner.'
            );

        }


        DB::transaction(function () use ($cards) {

            foreach ($cards as $card) {

                $card->update([

                    'remise_uneac' => true,

                    'date_remise_uneac' =>
                        Carbon::today(),

                ]);

            }

        });


        return redirect()
            ->route('cards.reception')
            ->with(
                'success',
                $cards->count() .
                (
                    $cards->count() > 1
                        ? ' cartes ont été enregistrées comme reçues par l’UNEAC.'
                        : ' carte a été enregistrée comme reçue par l’UNEAC.'
                )
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE CARTES À REMETTRE AUX MEMBRES
    |--------------------------------------------------------------------------
    */

    public function delivery(Request $request)
    {
        $query = Card::with([
            'member.category',
            'member.federation',
        ])
        ->where(
            'statut_production',
            'produite'
        )
        ->where(
            'remise_uneac',
            true
        )
        ->where(
            'remise_artiste',
            false
        );


        /*
        |--------------------------------------------------------------------------
        | RECHERCHE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'numero_carte',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas(
                    'member',
                    function ($member) use ($search) {

                        $member
                            ->where(
                                'numero_membre',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'nom',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'postnom',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'prenom',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'telephone',
                                'like',
                                "%{$search}%"
                            );

                    }
                );

            });

        }


        /*
        |--------------------------------------------------------------------------
        | FÉDÉRATION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('federation_id')) {

            $query->whereHas(
                'member',
                function ($member) use ($request) {

                    $member->where(
                        'federation_id',
                        $request->federation_id
                    );

                }
            );

        }


        $cards = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();


        $federations = Federation::orderBy('nom')
            ->get();


        return view(
            'cards.delivery',
            compact(
                'cards',
                'federations'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ENREGISTRER LA REMISE AU MEMBRE
    |--------------------------------------------------------------------------
    |
    | L'Admin UNEAC sélectionne les cartes remises aux membres.
    |
    */

    public function storeDelivery(Request $request)
    {
        $validated = $request->validate([

            'cards' => [
                'required',
                'array',
                'min:1',
            ],

            'cards.*' => [
                'integer',
                'exists:cards,id',
            ],

        ]);


        $cards = Card::whereIn(
            'id',
            $validated['cards']
        )
        ->where(
            'statut_production',
            'produite'
        )
        ->where(
            'remise_uneac',
            true
        )
        ->where(
            'remise_artiste',
            false
        )
        ->get();


        if ($cards->isEmpty()) {

            return back()->with(
                'error',
                'Aucune carte valide à remettre.'
            );

        }


        DB::transaction(function () use ($cards) {

            foreach ($cards as $card) {

                $card->update([

                    'remise_artiste' => true,

                    'date_remise_artiste' =>
                        Carbon::today(),

                ]);

            }

        });


        return redirect()
            ->route('cards.delivery')
            ->with(
                'success',
                $cards->count() .
                (
                    $cards->count() > 1
                        ? ' cartes ont été enregistrées comme remises aux membres.'
                        : ' carte a été enregistrée comme remise au membre.'
                )
            );
    }
}
