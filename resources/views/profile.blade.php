<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <a href="#" id="Titulo" class="logo">GAMMING ESPE</a>
            <nav>
                <a href="{{ route('home') }}" class="left">Inicio</a>
                <a href="{{ route('logout') }}" class="right"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
    </header>
    <main>
        <h1>Perfil de {{ $user->name }}</h1>
        <p>Email: {{ $user->email }}</p>
        <!-- Añade más detalles del perfil aquí -->
    </main>
</body>
</html>
