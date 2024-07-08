<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@juegos.com',
        ]);

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@juegos.com',
        ]);
        $role = Role::create(['name' => 'admin']);

        $user->assignRole($role);
    }
}
