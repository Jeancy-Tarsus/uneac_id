<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Données UNEAC
        $this->call([
            CategorySeeder::class,
            FederationSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
