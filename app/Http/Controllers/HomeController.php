<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // asegúrate de que tu controlador HomeController tenga el método index configurado para devolver la vista home.
    public function index()
    {
        return view('home');
    }
}
