<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Clientes</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            margin-right:40px;
        }
        .store-info {
            text-align: left;
        }
        .store-info h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .store-info p {
            margin: 0;
            font-size: 15px;
        }
        .header img {
            max-width: 150px;
        }
        h1 {
            text-align: left;
            margin-bottom: 30px;
            font-size: 20px;
            color: #343a40;
            padding-top: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            font-size:15px;
        }
        th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tbody tr:hover {
            background-color: #e9ecef;
        }
        

    </style>
</head>
<body>
    
<div style="width: 100%; overflow: visible;margin-bottom:165px">
    <div style="float: left; width: 70%; font-size: 14px; line-height: 1.2;">
       <br> <h2 style="margin: 0;">Nombre de la Tienda</h2>
        <p style="margin: 5px 0;">Dirección de la Tienda</p>
        <p style="margin: 5px 0;">Teléfono: +123 456 7890</p>
        <p style="margin: 5px 0;">Email: contacto@tienda.com</p>
    </div>
    <div style="float: right; width: 25%;">
        <img src="{{ public_path('images/Logo3.jpg') }}" alt="Logo de la Tienda" style="max-width: 100%; height: auto;">
    </div>
</div>





    <h1>Reporte de Comprobante</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Carrito</th>
                <th>Fecha</th>
                <th>Monto total</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reporteComprobante as $comprobante)
                <tr>
                    <td>{{ $comprobante->id }}</td>
                    <td>{{$comprobante->cliente->name }}</td>
                    <td>{{ $comprobante->carrito_id }}</td>
                    <td>{{ $comprobante->fecha }}</td>
                    <td>{{ $comprobante->monto_total }}</td>
                    <td>{{ $comprobante->estado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Enlace a Bootstrap JS (opcional si necesitas funcionalidades JS de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
