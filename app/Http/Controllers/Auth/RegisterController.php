<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cliente; // Asegúrate de incluir el modelo Cliente
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB; // Importar DB para transacciones
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja el registro de nuevos usuarios, así como su
    | validación y creación. Por defecto, este controlador utiliza un trait
    | para proporcionar esta funcionalidad sin requerir código adicional.
    |
    */

    use RegistersUsers;

    /**
     * Dónde redirigir a los usuarios después del registro.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crear una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Obtener un validador para una solicitud de registro entrante.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

    /**
     * Crear una nueva instancia de usuario después de un registro válido.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return DB::transaction(function () use ($data) {
            // Crear el usuario
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'year_of_birth' => $data['year_of_birth'],
                'phone_number' => $data['phone_number'],
                'Direccion' => $data['Direccion'],
            ]);

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

    }
}

