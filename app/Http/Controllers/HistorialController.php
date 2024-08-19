<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Categoria;
use App\Models\Plataforma;
use App\Models\carrito;
use App\Models\Cliente;
use App\Models\DetallesCarrito;
use App\Models\comprobante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class HistorialController extends Controller
{
    public function mostrarHistorial()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Obtener todos los productos directamente del modelo
        $categorias = Categoria::all(); 
        $plataformas = Plataforma::all();
        $productos = Productos::all();
        $comprobantes=comprobante::all();
        // Encontrar el cliente usando el correo electrónico del usuario
        $cliente = Cliente::where('email', $user->email)->first();
    
        if (!$cliente) {
            return redirect()->route('home')->with('error', 'Cliente no encontrado.');
        }
    
        // Obtener todos los carritos del cliente y sus comprobantes
        $carritos = Carrito::where('cliente_id', $cliente->id)
            ->with(['detallesCarrito', 'comprobante']) // Asegúrate de que tienes las relaciones configuradas en los modelos
            ->orderBy('fecha_creacion', 'desc') // Ordenar por fecha de creación
            ->get();
        // Debugging: Verifica que los datos se están cargando correctamente
        Log::info('Carritos con comprobantes:', ['carritos' => $carritos]);

        return view('historial', [
            'carritos' => $carritos,
            'user' => $user,
            'categorias' => $categorias,
            'plataformas' => $plataformas
        ]);
    }
}
