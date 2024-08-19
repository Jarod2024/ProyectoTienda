<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@extends('dash')

@section('content')
<form id="transferForm" action="{{ route('comprobante') }}" method="POST">
    @csrf
    <div class="d-flex justify-content-center mt-4">
        <div class="card" style="width: 100%; max-width: 600px; min-width: 300px; transition: none !important; transform: none !important;">
            <div class="card-header bg-custom">
                <h1 class="h4 mb-0">Orden Generada</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header-box mb-2">
                            <h2 class="h5">Información del Cliente</h2>
                        </div>
                        <p><strong>Nombre:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Teléfono:</strong> {{ $user->phone_number }}</p>
                        <p><strong>Dirección:</strong> {{ $user->Direccion }}</p>
                        <!-- Add more user details as needed -->
                        <input type="hidden" name="cliente_id" value="{{ $user->id }}">
                        <input type="hidden" name="carrito_id" value="{{ $carrito->id }}">
                    </div>
                </div>
                <div class="header-box mb-2">
                    <h2 class="h5">Detalles del Carrito</h2>
                </div>
                <div class="table-responsive mb-2" style="max-height: {{ count($carrito->detallesCarrito) > 3 ? '200px' : 'auto'; }}; overflow-y: auto;">
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
                            @php $total = 0; @endphp
                            @foreach($carrito->detallesCarrito as $detalle)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ number_format($detalle->precio, 2) }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>{{ number_format($detalle->subtotal, 2) }}</td>
                                    @php $total += $detalle->subtotal; @endphp
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>{{ number_format($total, 2) }}</strong></td>
                                <input type="hidden" name="monto_total" value="{{ $total }}">
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @php
                    $isComprobantePresent = $carrito->comprobante !== null;
                @endphp
                <button type="button" class="btn btn-lg btn-success" 
                    data-toggle="modal" 
                    data-target="#transferModal"
                    @if($isComprobantePresent) disabled @endif>
                    Confirmar Orden
                </button>
            </div>
        </div>
    </div>
    <!-- Modal HTML -->
    <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transferModalLabel">Confirmación de Transferencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Por favor, realice la transferencia a la siguiente cuenta:</p>
                    <p><strong>Número de cuenta:</strong> 123-456-789</p> <!-- Cambia esto por tu número de cuenta real -->
                    <p>Ingrese el código de transferencia:</p>
                    <input type="text" id="transferCode" name="cod_transferencia" class="form-control" placeholder="Código de transferencia">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="submitTransfer" class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('submitTransfer').addEventListener('click', function () {
        var transferCode = document.getElementById('transferCode').value;
        
        if (transferCode.trim() === '') {
            alert("Ingrese el código de transferencia por favor");
            return; // Detiene la ejecución si el código está vacío
        }

        // Asegúrate de que el formulario esté presente y tenga el ID correcto
        var form = document.getElementById('transferForm'); // Usa el ID del formulario
        if (!form) {
            alert("Formulario no encontrado");
            return;
        }

        // Agrega el código de transferencia como un campo oculto
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'cod_transferencia';
        input.value = transferCode;
        form.appendChild(input);

        // Envía el formulario
        form.submit();
    });
</script>

@endsection

@push('styles')
<style>
    .header-box {
        padding: 8px;
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
        background-color: #ffc133; /* Cambia esto al color deseado para el fondo */
        color: #ffffff; /* Cambia esto al color deseado para el texto */
        width: 100%;
        text-align: center !important;
        font-family: serif;
        margin-bottom: -10px;
    }
    .table thead {
        background-color: #6c757d; /* Cambia esto al color de fondo deseado */
        color: #ffffff; /* Cambia esto al color del texto deseado */
    }

    /* Optional: Ensure the modal is centered properly */
    .modal-dialog-centered {
        display: flex;
        position: relative;
        align-items: center;
        justify-content: center;
        min-height: 100vh; /* Ensure it takes up the full viewport height */
    }
</style>
@endpush

</body>
</html>
