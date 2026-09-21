<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Federation;

class FederationSeeder extends Seeder
{
    public function run(): void
    {
        Federation::insert([

            [
                'nom' => 'Fédération des Écrivains Congolais',
                'sigle' => 'FEC',
                'description' => 'Fédération regroupant les écrivains et acteurs du domaine de la littérature.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Fédération des Musiciens Congolais',
                'sigle' => 'FEMUC',
                'description' => 'Fédération regroupant les musiciens et professionnels du domaine musical.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Fédération des Artistes Plasticiens',
                'sigle' => 'FAP',
                'description' => 'Fédération regroupant les artistes exerçant dans les arts plastiques et visuels.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Fédération des Hommes de Théâtre',
                'sigle' => 'FHT',
                'description' => 'Fédération regroupant les professionnels du théâtre et des arts de la scène.',
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
