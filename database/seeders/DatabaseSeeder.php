<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder; // Verwijder de spatie

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class, // Verwijder de spatie hier ook
            // Voeg hier andere seeders toe als dat nodig is
        ]);
    }
}
