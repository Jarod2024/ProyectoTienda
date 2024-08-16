<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap CSS and JS -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <div class="ml-auto d-flex align-items-center">
                <div class="container-icon">
                    <button id="cart-button" class="btn btn-link" onclick="openCartModal()">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                        <span id="contador-productos" class="custom-counter">0</span>
                    </button>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <i class="fas fa-angle-double-left"></i>
                <span class="brand-text font-weight-light">  go to Home</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-header">VIDEOJUEGOS</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Plataformas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($plataformas as $plataforma)
                                <li class="nav-item">
                                    <a href="{{ url('/plataformas/' . $plataforma->id) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $plataforma->nombre }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Categorias
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($categorias as $categoria)
                                <li class="nav-item">
                                    <a href="{{ url('/categorias/' . $categoria->id) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ $categoria->nombre }}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
          <!-- Modal -->
          <div class="modal fade" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg"> <!-- Add 'modal-lg' for a larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carritoModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="lista-carrito">
                        <!-- Los productos del carrito se agregarán aquí -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
            <button id="generarOrdenButton" type="button" class="btn btn-primary">Generar Orden</button>
            </div>
        </div>
    </div>
</div>
    <!-- Custom JavaScript -->

 
<script src="{{ asset('js/index.js') }}"> </script>
<script>
    // Incrustar la URL generada en una variable JavaScript
    const generateOrderUrl = "{{ route('generar') }}";
</script>
</body>
</html>
