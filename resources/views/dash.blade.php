<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- AdminLTE -->
 <!-- jQuery -->
 <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

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
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
       <!-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <span class="brand-text font-weight-light">Home</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/videojuegos') }}" class="nav-link">
                            <i class="fas  fa-gamepad"></i>
                                <p>Todos</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>-->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
    <i class="fas fa-angle-double-left"></i>
        <span class="brand-text font-weight-light">  go to Home</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Videojuegos Title -->
                <li class="nav-header">VIDEOJUEGOS</li>
                <!-- Plataformas Menu -->
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
                <!-- Categorias Menu -->
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


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
    </div>

    <script src="{{ asset('vendor/adminlte/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
