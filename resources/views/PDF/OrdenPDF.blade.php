<!-- resources/views/pdf/orden.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden {{ $carrito->id }}</title>
    <style>
        /* Puedes agregar aquí tu estilo para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        h1, h2 {
            text-align: center;
        }
        .details {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Orden #{{ $carrito->id }}</h1>
        <h2>Detalles del Cliente</h2>
    <p><strong>Nombre:</strong> {{ $cliente->name }}</p>
    <p><strong>Email:</strong> {{ $cliente->email }}</p>
    <p><strong>Teléfono:</strong> {{ $cliente->phone_number }}</p>
    <p><strong>Dirección:</strong> {{ $cliente->Direccion }}</p>
        <p>Fecha de Creación: {{ $carrito->fecha_creacion }}</p>

        <h2>Detalles de la Orden</h2>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carrito->detallesCarrito as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ $detalle->precio }}</td>
                    <td>${{ $detalle->subtotal }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
