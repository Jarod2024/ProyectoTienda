<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        /*if ($categories->isEmpty()) {
            $data = [
                'message' => 'No se encontraron categorias',
                'status' => 200
            ];
            return response()->json($data, 400);
        }*/
        $data = [
            'categories' => $categories,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'platform' => 'required|string'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $category = Category::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'slug'=> $request->slug,
            'platform'=> $request->platform
        ]);

        if(!$category){
            $data = [
                'message' => 'Error al crear la categoria',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'category' => $category,
            'status' => 201
        ];

        return response()->json($data, 201);

    }
    
}
