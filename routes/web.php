<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FederationController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::resource('categories', CategoryController::class);

Route::resource('federations', FederationController::class);

Route::resource('members', MemberController::class);

Route::resource('cards', CardController::class);

Route::get('/verification/{qr_token}', [VerificationController::class, 'show'])
    ->name('verification.show');


Route::get('/cards/{card}/preview', [CardController::class, 'preview'])
    ->name('cards.preview');
