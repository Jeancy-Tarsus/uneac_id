<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Compte Super Administrateur
        User::updateOrCreate(
            ['email' => 'admin@uneac.cg'],
            [
                'name' => 'Super Administrateur',
                'password' => Hash::make('azertyui'),
                'role' => 'super_admin',
            ]
        );

        // Compte Administrateur UNEAC
        User::updateOrCreate(
            ['email' => 'uneac@uneac.cg'],
            [
                'name' => 'Administrateur UNEAC',
                'password' => Hash::make('azertyui'),
                'role' => 'admin_uneac',
            ]
        );
    }
}
