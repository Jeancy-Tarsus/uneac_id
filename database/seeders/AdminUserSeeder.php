<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@uneac.cg'],
            [
                'name' => 'Super Administrateur',
                'password' => Hash::make('azertyui'),
                'role' => 'super_admin',
            ]
        );

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
