<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: Crear una condicion para que si el usuario ya
        // existe, solo lo recupere. Si no existe, entonces lo cree

        // Creacion de un nuevo usuario administrador
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@juegos.com'
        ]);

        // Obtencion del rol admin para asignar al usuario
        $role = Role::findByName('admin');

        $user->assignRole($role);
    }
}
