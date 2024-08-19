<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class platformController extends Controller
{
    public function index()
    {
        $platforms = Platform::all();

        /*if ($platforms->isEmpty()) {
            $data = [
                'message' => 'No se encontraron plataformas',
                'status' => 200
            ];
            return response()->json($data, 400);
        }*/
        $data = [
            'platforms' => $platforms,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255'
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validación de los datos',
            'errors' => $validator->errors(),
            'status' => 400
        ];
        return response()->json($data, 400);
    }

    // Verificar si la plataforma ya existe
    $existingPlatform = Platform::where('name', $request->name)->first();

    if ($existingPlatform) {
        $data = [
            'message' => 'La plataforma ya existe',
            'status' => 400
        ];
        return response()->json($data, 400);
    }

    // Crear la nueva plataforma si no existe
    $platform = Platform::create([
        'name' => $request->name
    ]);

    if (!$platform) {
        $data = [
            'message' => 'Error al crear la plataforma',
            'status' => 500
        ];
        return response()->json($data, 500);
    }

    $data = [
        'platform' => $platform,
        'status' => 200
    ];

    return response()->json($data, 200);
}


    public function show($id)
    {
        $platform = Platform::find($id);

        if(!$platform){
            $data = [
                'message' => 'Plataforma no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'platform' => $platform,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $platform = Platform::find($id);

        if(!$platform){
            $data = [
                'message' => 'Plataforma no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $platform->delete();

        $data = [
            'message' => 'Plataforma eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $platform = Platform::find($id);

        if(!$platform){
            $data = [
                'message' => 'Plataforma no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $platform->name = $request->name;
        $platform->save();

        $data = [
            'platform' => $platform,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $platform = Platform::find($id);

        if(!$platform){
            $data = [
                'message' => 'Plataforma no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if($request->name){
            $platform->name = $request->name;
        }

        $platform->save();

        $data = [
            'platform' => $platform,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
