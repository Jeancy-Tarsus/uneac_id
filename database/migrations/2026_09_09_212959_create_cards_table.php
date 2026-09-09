<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            // Membre auquel appartient la carte
            $table->foreignId('member_id')
                ->constrained('members')
                ->cascadeOnDelete();

            // Identifiants de la carte
            $table->string('numero_carte')->unique();
            $table->string('qr_token')->unique();

            // Validité
            $table->date('date_delivrance');
            $table->date('date_expiration');

            // État de la carte
            $table->enum('statut', [
                'active',
                'expiree',
                'suspendue',
                'revoquee'
            ])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
