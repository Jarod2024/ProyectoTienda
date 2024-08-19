@extends('dash')

@section('content')
<div class="d-flex justify-content-center mt-5">
<div class="card" style="width: 50%; transition: none !important;transform: none !important;">
        <div class="card-header bg-custom">
            <h1 class="h4  mb-0">Orden Generada</h1>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                <div class="header-box mb-4">
                        <h2 class="h5">Información del Cliente</h2>
                    </div>
                    <p><strong>Nombre:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $user->phone_number }}</p>
                    <p><strong>Dirección:</strong> {{ $user->Direccion }}</p>
                    <!-- Add more user details as needed -->
                </div>
            </div>

            <div class="header-box mb-4">
                <h2 class="h5">Detalles del Carrito</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($carrito->detallesCarrito as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ number_format($detalle->precio, 2) }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-right mt-4">
                <button type="button" class="btn btn-lg btn-success">Confirmar Orden</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .header-box {
        padding: 10px;
    background-color: black; /* Gris */
    border: 1px solid #5a6268; /* Gris oscuro */
    border-radius: 4px;
    color: white;
    margin: 0;
    box-sizing: border-box;
    }
    .header-box h2 {
        margin: 0;
        color: white; /* Color del texto del encabezado */
    }
    .bg-custom {
    background-color:#ffc133; /* Cambia esto al color deseado para el fondo */
    color: #ffffff; /* Cambia esto al color deseado para el texto */
}
.table thead {
    background-color: #6c757d; /* Cambia esto al color de fondo deseado */
    color: #ffffff; /* Cambia esto al color del texto deseado */
}


</style>
@endpush