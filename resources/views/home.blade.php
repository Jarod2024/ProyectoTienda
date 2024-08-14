<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAMMING ESPE</title>
    <!-- Enlaza el archivo CSS -->
      <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <div class="container">
            <a href="#" id="Titulo" class="logo">GAMMING ESPE</a>
            <nav>
                <div class="InputContainer">
                    <input placeholder="Search.." id="input" class="input" name="text" type="text">
                </div>
                <a href="{{ route('home') }}" class="left">Inicio</a>
                
                <!-- Añade un enlace a la página de perfil aquí -->

                @if(Auth::check())
                    <a href="{{ route('profile') }}" class="right">{{ Auth::user()->name }}</a>
                    <a href="{{ route('logout') }}" class="right"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="right">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="right">Registrarse</a>
                @endif
            </nav>
        </div>
    </header>
    <main>
        <section class="welcome">
            <div class="welcome-text">
                <h1>BIENVENIDO ENTRETENIMIENTO GAMMING</h1>
                <p>Bienvenido al nuestro rincón virtual de entretenimiento gamming donde la emoción y la aventura se fusionan. La personas amantes de los video juegos tenemos variedad de productos que les puede interesar y muchos juegos de estreno.</p>
                <button class="btn-primary" onclick="window.location.href='{{ route('videojuegos') }}'">Ver más videojuegos</button>
            </div>
            <div class="welcome-image-section">
                <div class="welcome-image">
                    <img src="https://cdn.lotuselectronics.com/webpimages/489441IM.webp" alt="Game Controller">
                </div>
                <div class="welcome-background-image-section"></div>
            </div>
        </section>
        <section class="offers">
            <h2>Oferta</h2>
            <div class="carousel-container">
                <button class="carousel-button prev" data-carousel="offers">&lt;</button>
                <div class="carousel-track-container">
                    <ul class="carousel-track">
                            
                        @foreach ($productos as $producto)
            @php
                $oferta = $producto->ofertas->descuento; // Porcentaje de oferta
                $precioAnterior = $producto->precio;
                $precioOferta = $oferta ? $precioAnterior - ($precioAnterior * ($oferta / 100)) : $precioAnterior;
            @endphp
            <li class="carousel-item">
                <div class="card h-100 Productos position-relative">
                    @if ($oferta >= 0)
                        <div class="discount-badge">
                            {{ $oferta }}% OFF
                        </div>
                    @endif
                    <img class="card-img-top  image" src="{{ asset('storage/' . $producto->imagen) }}" alt="...">
                    <div class="card-body p-3">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $producto->nombre }}</h5>
                            @if ($oferta > 0)
                                <div class="old-price">${{ $precioAnterior }}</div>
                                <div class="precio">${{ number_format($precioOferta, 2) }}</div>
                            @else
                                <div class="precio">${{ number_format($precioAnterior, 2) }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer p-3 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                        <p class="ver-detalles">Ver detalles</p> <!-- Texto clickeable para mostrar detalles -->
                        <div class="detalles">
                        @if ($oferta > 0)
                                <p>Descuento válido desde</p>
                                <p>{{ $producto->ofertas->fecha_inicio }} al {{ $producto->ofertas->fecha_fin }}</p>
                            @endif
                                </div>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
                            


                  

                    </ul>
                    <button class="carousel-button next" data-carousel="offers">&gt;</button>
                </div>
                
            </div>
        </section>
        <section class="new-releases">
            <h2>Estrenos 2025</h2>
            <div class="carousel-container">
                <button class="carousel-button prev" data-carousel="new-releases">&lt;</button>
                <div class="carousel-track-container">
                <ul class="carousel-track">
                        @foreach ($estrenos as $estreno)
                        <li class="carousel-item">
                            <div class="card h-100 Productos position-relative">
                            <div class="new-badge">New</div>
                            <img class="card-img-top image" src="{{ asset('storage/' . $estreno->imagen) }}" alt="...">
                            <div class="card-body p-4">
                                <div class="text-center">
                                <h5 class="fw-bolder">{{ $estreno->nombre }}</h5>
                                <div class="precio">${{ number_format($estreno->precio, 2) }}</div>
                                </div>
                            </div>
                            </div>
                        </li>
                        @endforeach
                        </ul>

                    <button class="carousel-button next" data-carousel="new-releases">&gt;</button>
                </div>
                
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>Síguenos en:</p>
            <div class="social-icons">
                <a href="#"><img src="{{ asset('images/instagram.png') }}" alt="Instagram"></a>
                <a href="#"><img src="{{ asset('images/facebook.png') }}" alt="Facebook"></a>
                <a href="#"><img src="{{ asset('images/twitter.png') }}" alt="Twitter"></a>
            </div>

            



        </div>
        
    </footer>
    <!-- Enlaza el archivo JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    
</body>
</html>
