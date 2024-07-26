<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Plataforma;
use App\Models\Categoria;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    
    public function index()
    {
       // Obtener todos los productos con ofertas
       $productos = Productos::with('ofertas')->has('ofertas')->get();
       $estrenos = Productos::with('estrenos')->has('estrenos')->get();
       // Obtener plataformas y categorías (asumiendo que tienes estos modelos)
       $plataformas = Plataforma::all();
       $categorias = Categoria::all();

       // Pasar los productos, plataformas y categorías a la vista
       return view('home',compact('productos', 'plataformas', 'categorias', 'estrenos'));
    }
}
