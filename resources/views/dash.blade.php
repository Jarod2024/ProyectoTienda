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
    <!-- Logo -->
    <a href="{{ url('/') }}" class="brand-link">
    <img src="{{asset('images/Logo1.jpg')}}"
                     style="width: 100%; max-width: 150px; height: 130px; border-radius: 50%; box-shadow: 0px 4px 15px rgba(156, 131, 164, 0.1); display: block; margin: 0 auto; object-fit: cover;"
                     alt="logo">
    </a>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Options under the logo -->
                <li class="nav-item">
                    <a href="{{ url('historial') }}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Mis órdenes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('descargas') }}" class="nav-link">
                        <i class="nav-icon fas fa-download"></i>
                        <p>Descargar Comprobantes</p>
                    </a>
                </li>

                <!-- Spacer for separation -->
                <li class="nav-item mt-5">
                    <div class="nav-divider"></div>
                </li>

                <!-- Videojuegos Section -->
                <li class="nav-header">VIDEOJUEGOS</li>
                
                <!-- Plataformas -->
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

                <!-- Categorías -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Categorías
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
                
                <!-- Go to Home -->
                <li class="nav-item" style="margin-top:90%">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-angle-double-left"></i>
                        <p>Go to Home</p>
                    </a>
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
          <div class="modal" id="carritoModal" tabindex="-1" aria-labelledby="carritoModalLabel" aria-hidden="true">
          
          <div class="modal-dialog modal-lg"> <!-- Add 'modal-lg' for a larger modal -->       
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="carritoModalLabel">Carrito de Compras</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
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
                            <th></th>
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
