<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Évite les doublons si le seeder est exécuté plusieurs fois
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'), // Utiliser un mot de passe sécurisé en production
                'role' => 'admin', // Rôle administrateur
            ]
        );
    }
}
