<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([

            [
                'nom' => 'Écrivain',
                'description' => 'Membres exerçant dans le domaine de l’écriture et de la littérature.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Musicien',
                'description' => 'Membres exerçant dans le domaine de la musique.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Artiste plasticien',
                'description' => 'Membres exerçant dans les arts plastiques et visuels.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Comédien',
                'description' => 'Membres exerçant dans le théâtre et l’interprétation.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Danseur',
                'description' => 'Membres exerçant dans le domaine de la danse.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Cinéaste',
                'description' => 'Membres exerçant dans le cinéma et la production audiovisuelle.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nom' => 'Photographe',
                'description' => 'Membres exerçant dans le domaine de la photographie.',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
