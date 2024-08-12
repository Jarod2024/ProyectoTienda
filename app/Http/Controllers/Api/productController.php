<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class productController extends Controller
{
    public function index()
    {
        $products = Product::all();

        /*if ($products->isEmpty()) {
            $data = [
                'message' => 'No se encontraron productos',
                'status' => 200
            ];
            return response()->json($data, 400);
        }*/
        $data = [
            'products' => $products,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'platform_id' => 'required|exists:platforms,id'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $product = Product::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'price'=> $request->price,
            'category_id'=> $request->category_id,
            'platform_id'=> $request->platform_id
        ]);

        if(!$product){
            $data = [
                'message' => 'Error al crear el producto',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        if(!$product){
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if(!$product){
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $product->delete();

        $data = [
            'message' => 'Producto eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'platform_id' => 'required|exists:platforms,id'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->platform_id = $request->platform_id;
        
        $product->save();

        $data = [
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            $data = [
                'message' => 'Producto no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'description' => 'max:255',
            'price' => 'numeric',
            'category_id' => 'exists:categories,id',
            'platform_id' => 'exists:platforms,id'
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
            $product->name = $request->name;
        }

        if($request->description){
            $product->description = $request->description;
        }

        if($request->price){
            $product->price = $request->price;
        }

        if($request->category_id){
            $product->category_id = $request->category_id;
        }

        if($request->platform_id){
            $product->platform_id = $request->platform_id;
        }

        $product->save();

        $data = [
            'product' => $product,
            'status' => 200
        ];

        return response()->json($data, 200);

    }
}