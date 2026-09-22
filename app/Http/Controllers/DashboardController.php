<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Category;
use App\Models\Federation;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES MEMBRES
        |--------------------------------------------------------------------------
        */

        $totalMembers = Member::count();

        $activeMembers = Member::where(
            'statut',
            'actif'
        )->count();

        $inactiveMembers = Member::where(
            'statut',
            'inactif'
        )->count();

        $suspendedMembers = Member::where(
            'statut',
            'suspendu'
        )->count();

        $newMembersThisMonth = Member::whereMonth(
            'created_at',
            now()->month
        )
        ->whereYear(
            'created_at',
            now()->year
        )
        ->count();


        /*
        |--------------------------------------------------------------------------
        | STATISTIQUES CARTES
        |--------------------------------------------------------------------------
        */

        $totalCards = Card::count();

        $activeCards = Card::where(
            'statut',
            'active'
        )->count();

        $expiredCards = Card::where(
            'statut',
            'expiree'
        )->count();

        $suspendedCards = Card::where(
            'statut',
            'suspendue'
        )->count();

        $revokedCards = Card::where(
            'statut',
            'revoquee'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | PRODUCTION DES CARTES
        |--------------------------------------------------------------------------
        */

        // Cartes créées mais pas encore imprimées
        $cardsPendingProduction = Card::where(
            'statut_production',
            'en_attente'
        )->count();


        // Cartes produites mais pas encore remises à l'UNEAC
        $cardsPendingUneacDelivery = Card::where(
            'statut_production',
            'produite'
        )
        ->where(
            'remise_uneac',
            false
        )
        ->count();


        // Cartes remises à l'UNEAC mais pas encore remises à l'artiste
        $cardsPendingArtistDelivery = Card::where(
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
        ->count();


        // Total des cartes déjà remises à l'UNEAC
        $cardsDeliveredToUneac = Card::where(
            'remise_uneac',
            true
        )->count();


        // Total des cartes déjà remises aux artistes
        $cardsDeliveredToArtists = Card::where(
            'remise_artiste',
            true
        )->count();


        /*
        |--------------------------------------------------------------------------
        | CATÉGORIES ET FÉDÉRATIONS
        |--------------------------------------------------------------------------
        */

        $totalCategories = Category::count();

        $totalFederations = Federation::count();


        /*
        |--------------------------------------------------------------------------
        | MEMBRES RÉCENTS
        |--------------------------------------------------------------------------
        */

        $recentMembers = Member::with([
            'category',
            'federation'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | CARTES RÉCENTES
        |--------------------------------------------------------------------------
        */

        $recentCards = Card::with([
            'member'
        ])
        ->latest()
        ->take(5)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | MEMBRES PAR CATÉGORIE
        |--------------------------------------------------------------------------
        */

        $membersByCategory = Category::withCount(
            'members'
        )
        ->orderByDesc(
            'members_count'
        )
        ->take(7)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | MEMBRES PAR FÉDÉRATION
        |--------------------------------------------------------------------------
        */

        $membersByFederation = Federation::withCount(
            'members'
        )
        ->orderByDesc(
            'members_count'
        )
        ->take(7)
        ->get();


        /*
        |--------------------------------------------------------------------------
        | ENVOI DES DONNÉES AU TABLEAU DE BORD
        |--------------------------------------------------------------------------
        */

        return view(
            'dashboard',
            compact(

                // Membres
                'totalMembers',
                'activeMembers',
                'inactiveMembers',
                'suspendedMembers',
                'newMembersThisMonth',

                // Cartes
                'totalCards',
                'activeCards',
                'expiredCards',
                'suspendedCards',
                'revokedCards',

                // Production
                'cardsPendingProduction',
                'cardsPendingUneacDelivery',
                'cardsPendingArtistDelivery',
                'cardsDeliveredToUneac',
                'cardsDeliveredToArtists',

                // Structures
                'totalCategories',
                'totalFederations',

                // Listes
                'recentMembers',
                'recentCards',

                // Répartitions
                'membersByCategory',
                'membersByFederation'
            )
        );
    }
}
