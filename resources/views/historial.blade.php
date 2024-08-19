<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('dash') {{-- Suponiendo que tienes un layout base llamado 'dash' --}}

@section('content')
<div class="container">
    <h1 class="mb-4">Historial de Compras</h1>

    @if($carritos->isEmpty())
        <p>No tienes historial de compras.</p>
    @else
        <div class="list-group">
            @foreach($carritos as $carrito)
                <div class="list-group-item">
                    <h4 class="mb-3">Orden ID: {{ $carrito->id }}</h4>
                    <p><strong>Fecha de Creación:</strong> {{ $carrito->fecha_creacion }}</p>
                    @if($carrito->comprobante)
    <p><strong>Total:</strong> {{ number_format($carrito->comprobante->monto_total, 2) }}</p>
@else
    <p><strong>Total:</strong> No disponible</p>
@endif

                    <p><strong>Estado:</strong> {{ $carrito->comprobante->estado ?? 'No registrado' }}</p>
                    <a href="{{ route('mostrar', ['carrito_id' => $carrito->id]) }}" class="btn btn-primary">Ver Detalle</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

</body>
</html>