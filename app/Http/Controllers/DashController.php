<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use  Filament\Resources\ProductosResource\Pages\ListProductos as ListProductosPage;

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
    public function products()
    {
        $resource = ProductosResource::make();
        $page = ListProductosPage::make($resource);
        $productos = $page->getResults(); // Obtener todos los productos

        return view('videojuegos', compact('productos'));
    }
}
