<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FederationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;


// =====================================================
// ACCUEIL
// =====================================================

Route::get('/', function () {
    return redirect()->route('login');
});


// =====================================================
// TABLEAU DE BORD
// =====================================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// =====================================================
// PROFIL
// =====================================================

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


// =====================================================
// AUTHENTIFICATION BREEZE
// =====================================================

require __DIR__ . '/auth.php';


// =====================================================
// GESTION UNEAC
// =====================================================

Route::middleware('auth')->group(function () {


    // =================================================
    // CATÉGORIES
    // =================================================

    Route::resource(
        'categories',
        CategoryController::class
    );


    // =================================================
    // FÉDÉRATIONS
    // =================================================

    Route::resource(
        'federations',
        FederationController::class
    );


    // =================================================
    // MEMBRES
    // =================================================

    Route::resource(
        'members',
        MemberController::class
    );


    // =================================================
    // CARTES
    // =================================================

    Route::resource(
        'cards',
        CardController::class
    );


    // =================================================
    // PRÉVISUALISATION DE LA CARTE
    // =================================================

    Route::get(
        '/cards/{card}/preview',
        [CardController::class, 'preview']
    )->name('cards.preview');


    // =================================================
    // PRODUCTION DES CARTES
    // =================================================

    Route::post(
        '/cards/{card}/produire',
        [CardController::class, 'produire']
    )->name('cards.produire');


    // =================================================
    // RÉCEPTION DES CARTES PAR L'UNEAC
    // =================================================

    Route::get(
        '/cards-reception',
        [CardController::class, 'reception']
    )->name('cards.reception');


    Route::post(
        '/cards-reception',
        [CardController::class, 'storeReception']
    )->name('cards.reception.store');


    // =================================================
    // CARTES À REMETTRE AUX MEMBRES
    // =================================================

    Route::get(
        '/cards-delivery',
        [CardController::class, 'delivery']
    )->name('cards.delivery');


    Route::post(
        '/cards-delivery',
        [CardController::class, 'storeDelivery']
    )->name('cards.delivery.store');

});


// =====================================================
// VÉRIFICATION QR
// =====================================================
//
// Cette route reste PUBLIQUE.
// Une personne peut scanner le QR sans être connectée.
//

Route::get(
    '/verification/{qr_token}',
    [VerificationController::class, 'show']
)->name('verification.show');

Route::resource('users', UserController::class);

// =====================================================
// FIN
// =====================================================
