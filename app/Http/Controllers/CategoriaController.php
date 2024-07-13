<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Plataforma;
use Illuminate\Routing\Controller as BaseController; 
use Illuminate\Http\Request;

class CategoriaController extends BaseController
{
    public function list()
    {
        // Obtener todos los productos directamente del modelo
        $categorias = Categoria::all(); 
        $plataformas = Plataforma::all();

        return view('dash', compact('plataformas','categorias'));
    }
}