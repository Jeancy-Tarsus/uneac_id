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

        $activeMembers = Member::where('statut', 'actif')->count();

        $inactiveMembers = Member::where('statut', 'inactif')->count();

        $suspendedMembers = Member::where('statut', 'suspendu')->count();

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

        $activeCards = Card::where('statut', 'active')->count();

        $expiredCards = Card::where('statut', 'expiree')->count();

        $suspendedCards = Card::where('statut', 'suspendue')->count();

        $revokedCards = Card::where('statut', 'revoquee')->count();


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

        $membersByCategory = Category::withCount('members')
            ->orderByDesc('members_count')
            ->take(7)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | MEMBRES PAR FÉDÉRATION
        |--------------------------------------------------------------------------
        */

        $membersByFederation = Federation::withCount('members')
            ->orderByDesc('members_count')
            ->take(7)
            ->get();


        return view('dashboard', compact(

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

            // Structures
            'totalCategories',
            'totalFederations',

            // Listes
            'recentMembers',
            'recentCards',

            // Répartitions
            'membersByCategory',
            'membersByFederation'

        ));
    }
}
