<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categoria;
use App\Models\Plataforma;
use Illuminate\Routing\Controller as BaseController; 
use Illuminate\Http\Request;

class juegoController extends BaseController
{
    public function list()
    {
        // Obtener todos los productos directamente del modelo
        $categorias = Categoria::all(); 
        $plataformas = Plataforma::all();
        $productos = Productos::all();
        return view('videojuegos', compact('plataformas','categorias','productos'));
    }
    public function index()
    {
        // Obtener todos los productos directamente del modelo
        $productos = Productos::all();
        return view('videojuegos', compact('productos'));
    }
    public function porPlataforma(Plataforma $plataforma)
    {
        $plataformas = Plataforma::all();
        $categorias = Categoria::all();
        $productos = $plataforma->productos;

        return view('filtros', compact('plataformas', 'categorias', 'productos'));
    }

    public function porCategoria(Categoria $categoria)
    {
        $plataformas = Plataforma::all();
        $categorias = Categoria::all();
        $productos = $categoria->productos;

        return view('filtros', compact('plataformas', 'categorias', 'productos'));
    }
}
