<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Cliente; // Asegúrate de incluir el modelo Cliente
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB; // Importar DB para transacciones
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Importar Log para registros
use Exception;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Direccion' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255'],
            'year_of_birth' => ['required', 'date'],
        ]);
    }

    protected function create(array $data)
    {
        try {
            // Registrar los datos que se reciben
            Log::info('Datos recibidos para crear usuario y cliente:', $data);

            return DB::transaction(function () use ($data) {
                // Obtener el rol 'user' para asignar al nuevo usuario
                $role = Role::findByName('Cliente');
                if (!$role) {
                    throw new Exception('Role not found');
                }

                // Crear el usuario
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                ]);
                $user->assignRole($role);

                // Crear el cliente
                Cliente::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'Direccion' => $data['Direccion'],
                    'phone_number' => $data['phone_number'],
                    'year_of_birth' => $data['year_of_birth'],
                ]);

                return $user;
            });
        } catch (Exception $e) {
            // Manejo del error
            Log::error('Error creating user and client: ' . $e->getMessage());
            throw new \Exception('Error creating user and client');
        }
    }
}
