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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'slug' => 'required',
            'platform' => 'required|in:Xbox,PS4,PS5,Switch,Windows,Mac,Mobile'
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

    public function show($id)
    {
        $category = Category::find($id);

        if(!$category){
            $data = [
                'message' => 'Categoria no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'category' => $category,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if(!$category){
            $data = [
                'message' => 'Categoria no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $category->delete();

        $data = [
            'message' => 'Categoria eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if(!$category){
            $data = [
                'message' => 'Categoria no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'slug' => 'required',
            'platform' => 'required|in:Xbox,PS4,PS5,Switch,Windows,Mac,Mobile'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = $request->slug;
        $category->platform = $request->platform;

        $category->save();

        $data = [
            'category' => $category,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $category = Category::find($id);

        if(!$category){
            $data = [
                'message' => 'Categoria no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'description' => 'max:255',
            'slug' => 'max:255',
            'platform' => 'in:Xbox,PS4,PS5,Switch,Windows,Mac,Mobile'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if($request->name){
            $category->name = $request->name;
        }

        if($request->description){
            $category->description = $request->description;
        }
        
        if ($request->slug) {
            $category->slug = $request->slug;
        }

        if($request->platform){
            $category->platform = $request->platform;
        }

        $category->save();

        $data = [
            'category' => $category,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    
}
