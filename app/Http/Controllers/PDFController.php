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
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
public function generarPdf($carrito_id)
{
    $carrito = carrito::with('detallesCarrito.producto')->find($carrito_id);

    if (!$carrito) {
        return redirect()->back()->with('error', 'Orden no encontrada.');
    }

    $usuario = auth()->user();
        $emailUsuario = $usuario->email;

        // Encontrar el cliente usando el correo electrónico del usuario
        $cliente = Cliente::where('email', $emailUsuario)->first();
    $pdf = Pdf::loadView('PDF.ordenPDF', [
        'carrito' => $carrito,
        'cliente' => $cliente
    ]);

    // Nombre del archivo PDF
    $pdfName = 'orden_' . $carrito->id . '.pdf';

    return $pdf->download($pdfName);
}
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
         // Obtén solo los carritos que tienen un comprobante asociado
        $carritos = Carrito::whereHas('comprobante')->get();
        // Obtener todos los carritos del cliente y sus comprobantes
        
        // Debugging: Verifica que los datos se están cargando correctamente
        Log::info('Carritos con comprobantes:', ['carritos' => $carritos]);

        return view('Descargas', [
            'carritos' => $carritos,
            'user' => $user,
            'categorias' => $categorias,
            'plataformas' => $plataformas
        ]);
    }
}