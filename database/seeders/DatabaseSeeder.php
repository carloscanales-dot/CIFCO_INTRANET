<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seeder para roles y permisos
        $this->call(RolesAndPermissionsSeeder::class);

        // Seeder para el primer usuario (Carlos)
        $this->call(FirstUserSeeder::class);
    }
}
