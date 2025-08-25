<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Controleer of de admin gebruiker al bestaat
        $adminExists = DB::table('users')->where('email', 'admin@ehb.be')->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'admin',
                'email' => 'admin@ehb.be',
                'password' => Hash::make('Password!321'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('Admin gebruiker succesvol aangemaakt!');
            $this->command->info('Email: admin@ehb.be');
            $this->command->info('Wachtwoord: Password!321');
        } else {
            $this->command->info('Admin gebruiker bestaat al!');
        }
    }
}
