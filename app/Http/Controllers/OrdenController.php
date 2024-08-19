<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categoria;
use App\Models\Plataforma;
use App\Models\carrito;
use App\Models\Cliente;
use App\Models\DetallesCarrito;
use App\Models\comprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;

class OrdenController extends Controller
{
    // ...

    public function generarOrden(Request $request)
    {

        $productosJson = $request->input('productos');
        $productos = json_decode($productosJson, true);
        // Validar que los productos no estén vacíos
        if (empty($productos)) {
            return response()->json(['message' => 'No hay productos en el carrito.'], 400);
        }

        try {
            // Registrar los datos que se reciben
            Log::info('Datos recibidos para generar la orden:', ['productos' => $productos]);
            // Obtener el usuario autenticado
        $usuario = auth()->user();
        $emailUsuario = $usuario->email;

        // Encontrar el cliente usando el correo electrónico del usuario
        $cliente = Cliente::where('email', $emailUsuario)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado.'], 400);
        }


            return DB::transaction(function () use ($productos, $cliente) {
                // Crear una nueva entrada en carritos
                $carrito = new carrito();
                $carrito->cliente_id = $cliente->id; // Asume que el usuario está autenticado
                $carrito->fecha_creacion = Carbon::now();
                $carrito->save();

                // Agregar los productos a detalles_carritos
                foreach ($productos as $producto) {
                    $detalle = new DetallesCarrito();
                    $detalle->carrito_id = $carrito->id;
                    $detalle->producto_id = $producto['id'];
                    $detalle->cantidad = $producto['cantidad'];
                    $detalle->precio = $producto['precio'];
                    $detalle->subtotal = $producto['precio'] * $producto['cantidad'];
                    $detalle->save();
                }

                // Registrar la creación exitosa de la orden
                Log::info('Orden creada exitosamente con ID: ' . $carrito->id);

                // Redirigir a la página de confirmación de orden
                return redirect()->route('mostrar', ['carrito_id' => $carrito->id]);
            });
        } catch (Exception $e) {
            // Manejo del error y registro
            Log::error('Error al generar la orden: ' . $e->getMessage());
            return response()->json(['message' => 'Error al generar la orden.'], 500);
        }
    }

    public function mostrarOrden(Request $request, $carrito_id)
    {
        // Obtener el carrito junto con los detalles del carrito, productos, y el cliente
        $carrito = carrito::with('detallesCarrito.producto') // Carga las relaciones necesarias
                          ->findOrFail($carrito_id);
                          $total=0;
        // Obtener el cliente asociado al carrito
        $user = $carrito->cliente; // Almacena el cliente en la variable $user
        $categorias = Categoria::all(); 
        $plataformas = Plataforma::all();
        // Pasar el carrito y el cliente a la vista
        return view('orden', [
            'carrito' => $carrito,
            'user' => $user,
            'categorias' => $categorias,
        'plataformas' => $plataformas,
        'total'=> $total
        ]);
    }
    public function showOrdenForm(Request $request)
    {
       
             // Obtener todos los productos directamente del modelo
           $categorias = Categoria::all(); 
           $plataformas = Plataforma::all();
           $productos = Productos::all();
        $user = Auth::user(); // Get the currently logged-in user
        $carrito = json_decode($request->session()->get('carrito', '[]')); // Retrieve the cart from session or however you store it
    
        return view('orden', compact('user', 'carrito','plataformas', 'categorias', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|integer|exists:clientes,id',
            'carrito_id' => 'required|integer|exists:carritos,id',
            'monto_total' => 'required|numeric',
            'cod_transferencia' => 'required|string',
        ]);
    
        try {
            // Registrar los datos que se reciben
            Log::info('Datos recibidos para agregar el comprobante:', $request->all());
    
            // Crear una nueva entrada en comprobantes
            $comprobante = new Comprobante();
            $comprobante->cliente_id = $request->input('cliente_id');
            $comprobante->carrito_id = $request->input('carrito_id');
            $comprobante->fecha = Carbon::now();
            $comprobante->monto_total = $request->input('monto_total');
            $comprobante->estado = 'Pendiente'; // O el estado que necesites
            $comprobante->cod_transferencia = $request->input('cod_transferencia');
            $comprobante->save();
    
            // Verificar si el comprobante se guardó
            Log::info('Comprobante creado exitosamente con ID: ' . $comprobante->id);
    
            // Redirigir a la ruta de historial
            return redirect()->route('historial')->with('success', 'Comprobante creado exitosamente.');
    
        } catch (Exception $e) {
            // Manejo del error y registro
            Log::error('Error al crear el comprobante: ' . $e->getMessage());
            return response()->json(['message' => 'Error al crear el comprobante.'], 500);
        }
    }
}
