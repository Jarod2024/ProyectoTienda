<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@extends('dash') {{-- Suponiendo que tienes un layout base llamado 'dash' --}}

@section('content')
<div class="container">
    <h1 class="mb-4">Comprobantes Disponibles</h1>

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
                        <p><strong>Estado:</strong> {{ $carrito->comprobante->estado }}</p>
                        <a href="{{ route('mostrar', ['carrito_id' => $carrito->id]) }}" class="btn btn-primary">Ver Detalle</a>
                        <a href="{{ route('descargar', ['carrito_id' => $carrito->id]) }}" class="btn btn-secondary">Imprimir</a>
                    @else
                        <p><strong>Total:</strong> No disponible</p>
                        <p><strong>Estado:</strong> No registrado</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
