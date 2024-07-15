<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use  Filament\Resources\ProductosResource\Pages\ListProductos as ListProductosPage;
use App\Models\Productos;
use App\Models\Plataforma;
use App\Models\Categoria;
class DashController extends BaseController
{
    //
    public function show()
    {

        return view('dash');
    }
    public function games(){
        return view('videojuegos');
    }
    public function list()
    {
        // Obtener todos los productos directamente del modelo
        $categorias = Categoria::all(); 
        $plataformas = Plataforma::all();

        return view('dash', compact('plataformas','categorias'));
    }
    public function index()
    {
        // Obtener todos los productos con ofertas
        $productos = Productos::with('ofertas')->has('ofertas')->get();
        // Obtener todos los productos que son estrenos
        $estrenos = Productos::with('estrenos')->has('estrenos')->get();
        // Obtener plataformas y categorías (asumiendo que tienes estos modelos)
        $plataformas = Plataforma::all();
        $categorias = Categoria::all();

        // Pasar los productos, plataformas y categorías a la vista
        return view('videojuegos', compact('productos', 'plataformas', 'categorias', 'estrenos'));
    }
}
