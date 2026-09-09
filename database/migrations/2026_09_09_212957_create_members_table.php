<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            // Identification UNEAC
            $table->string('numero_membre')->unique();

            // Identité
            $table->string('nom');
            $table->string('postnom')->nullable();
            $table->string('prenom');

            $table->date('date_naissance')->nullable();
            $table->string('sexe')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('nationalite')->default('Congolaise');

            // Coordonnées
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->text('domicile')->nullable();

            // Informations artistiques
            $table->string('profession_artistique')->nullable();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->foreignId('federation_id')
                ->nullable()
                ->constrained('federations')
                ->nullOnDelete();

            // Photo du membre
            $table->string('photo')->nullable();

            // Adhésion
            $table->date('date_adhesion')->nullable();

            // Statut du membre
            $table->enum('statut', [
                'actif',
                'suspendu',
                'inactif'
            ])->default('actif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
