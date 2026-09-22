<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            // Ancien suivi de remise
            $table->dropColumn([
                'remise',
                'date_remise',
            ]);

            // Remise du producteur à l'UNEAC
            $table->boolean('remise_uneac')
                ->default(false)
                ->after('statut_production');

            $table->date('date_remise_uneac')
                ->nullable()
                ->after('remise_uneac');

            // Remise de l'UNEAC au membre/artiste
            $table->boolean('remise_artiste')
                ->default(false)
                ->after('date_remise_uneac');

            $table->date('date_remise_artiste')
                ->nullable()
                ->after('remise_artiste');
        });
    }

    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn([
                'remise_uneac',
                'date_remise_uneac',
                'remise_artiste',
                'date_remise_artiste',
            ]);

            $table->boolean('remise')
                ->default(false)
                ->after('statut_production');

            $table->date('date_remise')
                ->nullable()
                ->after('remise');
        });
    }
};
