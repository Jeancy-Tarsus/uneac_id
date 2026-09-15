<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

                        $memberQuery
                            ->where('numero_membre', 'like', "%{$search}%")
                            ->orWhere('nom', 'like', "%{$search}%")
                            ->orWhere('postnom', 'like', "%{$search}%")
                            ->orWhere('prenom', 'like', "%{$search}%")
                            ->orWhere('telephone', 'like', "%{$search}%");
                    });
            });
        }

        // Statut de la carte
        if ($request->filled('status')) {
            $query->where('statut', $request->status);
        }

        // Statut de production
        if ($request->filled('production')) {
            $query->where(
                'statut_production',
                $request->production
            );
        }

        // Remise
        if ($request->filled('remise')) {
            $query->where(
                'remise',
                $request->remise
            );
        }

        $cards = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'cards.index',
            compact('cards')
        );
    }


    /**
     * Formulaire de création
     */
    public function create()
    {
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Vous n\'êtes pas autorisé à créer une carte.'
                );
        }

        // La création se fait dans la modale de la page index
        return redirect()
            ->route('cards.index');
    }


    /**
     * Enregistrer une nouvelle carte
     */
    public function store(Request $request)
    {
        // Seul le super administrateur peut créer une carte
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Vous n\'êtes pas autorisé à créer une carte.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        |
        | IMPORTANT :
        | date_expiration n'est PAS récupérée depuis le formulaire.
        | Elle sera calculée automatiquement par Laravel.
        |
        */

        $validated = $request->validate([

            'member_id' => [
                'required',
                'exists:members,id',
                'unique:cards,member_id'
            ],

            'date_delivrance' => [
                'required',
                'date'
            ],

            'statut' => [
                'required',
                'in:active,expiree,suspendue,revoquee'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | DATE D'EXPIRATION : AUTOMATIQUE À +1 AN
        |--------------------------------------------------------------------------
        */

        $dateDelivrance = Carbon::parse(
            $validated['date_delivrance']
        );

        $validated['date_expiration'] = $dateDelivrance->copy()->addYear();


        /*
        |--------------------------------------------------------------------------
        | VÉRIFICATION SUPPLÉMENTAIRE DU MEMBRE
        |--------------------------------------------------------------------------
        */

        if (
            Card::where(
                'member_id',
                $validated['member_id']
            )->exists()
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Ce membre possède déjà une carte.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | GÉNÉRATION DU NUMÉRO DE CARTE
        |--------------------------------------------------------------------------
        */

        $lastCard = Card::latest('id')->first();

        $nextNumber = $lastCard
            ? $lastCard->id + 1
            : 1;

        $validated['numero_carte'] =
            'UNEAC-C-' .
            str_pad(
                $nextNumber,
                5,
                '0',
                STR_PAD_LEFT
            );


        /*
        |--------------------------------------------------------------------------
        | GÉNÉRATION DU QR TOKEN
        |--------------------------------------------------------------------------
        */

        do {

            $qrToken = Str::random(40);

        } while (
            Card::where(
                'qr_token',
                $qrToken
            )->exists()
        );

        $validated['qr_token'] = $qrToken;


        /*
        |--------------------------------------------------------------------------
        | ÉTAT INITIAL DE LA CARTE
        |--------------------------------------------------------------------------
        */

        $validated['statut_production'] = 'en_attente';

        $validated['remise'] = false;

        $validated['date_remise'] = null;


        /*
        |--------------------------------------------------------------------------
        | CRÉATION
        |--------------------------------------------------------------------------
        */

        Card::create($validated);


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'Carte créée avec succès. Elle est valable pendant un an et est maintenant en attente de production.'
            );
    }


    /**
     * Voir une carte
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
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Vous n\'êtes pas autorisé à modifier cette carte.'
                );
        }

        $card->load('member');

        return view(
            'cards.modals.edit',
            compact('card')
        );
    }


    /**
     * Mettre à jour une carte
     */
    public function update(
        Request $request,
        Card $card
    ) {
        // Seul le super administrateur peut modifier
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Vous n\'êtes pas autorisé à modifier cette carte.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        |
        | On NE demande PAS date_expiration.
        | Laravel va automatiquement la recalculer.
        |
        */

        $validated = $request->validate([

            'date_delivrance' => [
                'required',
                'date'
            ],

            'statut' => [
                'required',
                'in:active,expiree,suspendue,revoquee'
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | RECALCUL AUTOMATIQUE DE L'EXPIRATION
        |--------------------------------------------------------------------------
        */

        $dateDelivrance = Carbon::parse(
            $validated['date_delivrance']
        );

        $validated['date_expiration'] =
            $dateDelivrance->copy()->addYear();


        /*
        |--------------------------------------------------------------------------
        | MISE À JOUR
        |--------------------------------------------------------------------------
        */

        $card->update($validated);


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'Carte mise à jour avec succès. La date d\'expiration a été recalculée automatiquement à un an après la date de délivrance.'
            );
    }


    /**
     * Prévisualiser / télécharger la carte
     *
     * Super administrateur uniquement.
     */
    public function preview(Card $card)
    {
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Vous n\'êtes pas autorisé à télécharger ou imprimer cette carte.'
                );
        }

        $card->load([
            'member.category',
            'member.federation'
        ]);

        return view(
            'cards.preview',
            compact('card')
        );
    }


    /**
     * Marquer comme produite
     *
     * Super administrateur uniquement.
     */
    public function markAsProduced(Card $card)
    {
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Seul le super administrateur peut marquer une carte comme produite.'
                );
        }

        // Déjà produite
        if ($card->statut_production === 'produite') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Cette carte est déjà marquée comme produite.'
                );
        }

        $card->update([
            'statut_production' => 'produite'
        ]);

        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'La carte a été marquée comme produite.'
            );
    }


    /**
     * Marquer comme remise
     *
     * Super administrateur + administrateur UNEAC.
     */
    public function markAsDelivered(Card $card)
    {
        if (
            auth()->user()->role !== 'super_admin'
            &&
            auth()->user()->role !== 'admin_uneac'
        ) {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Vous n\'êtes pas autorisé à remettre une carte.'
                );
        }


        // La carte doit être produite
        if ($card->statut_production !== 'produite') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Cette carte doit d\'abord être produite avant d\'être remise.'
                );
        }


        // La carte est déjà remise
        if ($card->remise) {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Cette carte a déjà été remise.'
                );
        }


        $card->update([
            'remise' => true,
            'date_remise' => now()->toDateString()
        ]);


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'La carte a été marquée comme remise.'
            );
    }


    /**
     * Annuler la remise
     *
     * Super administrateur uniquement.
     */
    public function cancelDelivery(Card $card)
    {
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Seul le super administrateur peut annuler une remise.'
                );
        }


        // La carte n'est pas remise
        if (!$card->remise) {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Cette carte n\'a pas encore été remise.'
                );
        }


        $card->update([
            'remise' => false,
            'date_remise' => null
        ]);


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'La remise de la carte a été annulée.'
            );
    }


    /**
     * Supprimer une carte
     *
     * Super administrateur uniquement.
     */
    public function destroy(Card $card)
    {
        if (auth()->user()->role !== 'super_admin') {

            return redirect()
                ->route('cards.index')
                ->with(
                    'error',
                    'Seul le super administrateur peut supprimer une carte.'
                );
        }


        $card->delete();


        return redirect()
            ->route('cards.index')
            ->with(
                'success',
                'Carte supprimée avec succès.'
            );
    }
}
