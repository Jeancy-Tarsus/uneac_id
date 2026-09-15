<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->enum('statut_production', [
                'en_attente',
                'produite'
            ])->default('en_attente')->after('statut');

            $table->boolean('remise')
                ->default(false)
                ->after('statut_production');

            $table->date('date_remise')
                ->nullable()
                ->after('remise');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->dropColumn([
                'statut_production',
                'remise',
                'date_remise',
            ]);
        });
    }
};
