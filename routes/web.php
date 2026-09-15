<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FederationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
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

    // Catégories
    Route::resource('categories', CategoryController::class);

    // Fédérations
    Route::resource('federations', FederationController::class);

    // Membres
    Route::resource('members', MemberController::class);

    // Cartes
    Route::resource('cards', CardController::class);


    // =================================================
    // SUIVI DE PRODUCTION DES CARTES
    // =================================================

    // Marquer une carte comme produite
    Route::post(
        '/cards/{card}/produire',
        [CardController::class, 'markAsProduced']
    )->name('cards.produce');


    // Marquer une carte comme remise
    Route::post(
        '/cards/{card}/remettre',
        [CardController::class, 'markAsDelivered']
    )->name('cards.deliver');


    // Annuler la remise
    Route::post(
        '/cards/{card}/annuler-remise',
        [CardController::class, 'cancelDelivery']
    )->name('cards.cancel-delivery');
});


// =====================================================
// VÉRIFICATION QR
// =====================================================

// Cette route reste PUBLIQUE.
// Une personne peut scanner le QR sans être connectée.

Route::get(
    '/verification/{qr_token}',
    [VerificationController::class, 'show']
)->name('verification.show');


Route::get('/cards/{card}/preview', [CardController::class, 'preview'])
    ->name('cards.preview');





    

// email: admin@uneac.cd
// password: Admin@2026
