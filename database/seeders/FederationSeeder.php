<?php

namespace Database\Seeders;

use App\Models\Federation;
use Illuminate\Database\Seeder;

class FederationSeeder extends Seeder
{
    public function run(): void
    {
        Federation::insert([
            [
                'nom' => 'Fédération des Écrivains Congolais',
                'sigle' => 'FEC',
                'description' => 'Fédération regroupant les écrivains membres de l’UNEAC.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Fédération des Musiciens Congolais',
                'sigle' => 'FEMUC',
                'description' => 'Fédération regroupant les musiciens membres de l’UNEAC.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Fédération des Artistes Plasticiens',
                'sigle' => 'FAP',
                'description' => 'Fédération regroupant les artistes plasticiens et artistes visuels.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Fédération des Hommes de Théâtre',
                'sigle' => 'FHT',
                'description' => 'Fédération regroupant les comédiens et professionnels du théâtre.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Fédération des Cinéastes Congolais',
                'sigle' => 'FCC',
                'description' => 'Fédération regroupant les cinéastes et professionnels de l’audiovisuel.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
