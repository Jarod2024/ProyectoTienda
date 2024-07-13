<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>
</head>
<body>
@extends('dash') {{-- Suponiendo que tienes un layout base llamado 'dash' --}}

@section('content')
    <h1>Videojuegos</h1><br>
   
    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4">
                <div class="card h-100 Productos">
                    <img class="card-img-top image" src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                    <div class="card-body p-3">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $producto->nombre }}</h5>
                            <span class="precio">${{ $producto->precio }}</span>
                        </div>
                    </div>
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a href="#" class="btn btn-outline-dark mt-auto">Añadir al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
</body>
</html>
