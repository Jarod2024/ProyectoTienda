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
                        {{ __('Logout') }}
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
            </div>
            <div class="welcome-image">
                <img src="{{ asset('images/controller.jpg') }}" alt="Game Controller">
            </div>
        </section>
        <section class="offers">
            <h2>Oferta</h2>
            <div class="carousel-container">
                <button class="carousel-button prev" data-carousel="offers">&lt;</button>
                <div class="carousel-track-container">
                    <ul class="carousel-track">
                        <li class="carousel-item">
                            <img src="{{ asset('images/spiderman.jpg') }}" alt="Spiderman">
                            <p>SPIDER-MAN</p>
                            <p>$13.25</p>
                            <span class="discount">30%</span>
                            
                            


                        </li>


                        





                        <li class="carousel-item">
                            <img src="{{ asset('images/godfall.jpg') }}" alt="Godfall">
                            <p>GODFALL</p>
                            <p>$6.25</p>
                            <span class="discount">25%</span>
                        </li>
                        <li class="carousel-item">
                            <img src="{{ asset('images/allstars.jpg') }}" alt="Allstars">
                            <p>ALLSTARS</p>
                            <p>$9.25</p>
                            <span class="discount">35%</span>
                        </li>
                        <li class="carousel-item">
                            <img src="{{ asset('images/morbld.jpg') }}" alt="Morbld">
                            <p>MORBLD</p>
                            <p>$3.25</p>
                            <span class="discount">70%</span>
                        </li>
                    </ul>
                    
                </div>
                <button class="carousel-button next" data-carousel="offers">&gt;</button>
            </div>
        </section>
        <section class="new-releases">
            <h2>Estrenos 2025</h2>
            <div class="carousel-container">
                <button class="carousel-button prev" data-carousel="new-releases">&lt;</button>
                <div class="carousel-track-container">
                    <ul class="carousel-track">
                        <li class="carousel-item">
                            <img src="{{ asset('images/nfs.jpg') }}" alt="NFS Unbound Palace">
                            <p>NFS UNBOUND PALACE</p>
                            <p>$4.25</p>
                        </li>
                        <li class="carousel-item">
                            <img src="{{ asset('images/dead_island.jpg') }}" alt="Dead Island 2">
                            <p>DEAD ISLAND 2</p>
                            <p>$7.50</p>
                        </li>
                        <li class="carousel-item">
                            <img src="{{ asset('images/suicide_squad.jpg') }}" alt="Suicide Squad">
                            <p>SUICIDE SQUAD</p>
                            <p>$13.25</p>
                        </li>
                        <li class="carousel-item">
                            <img src="{{ asset('images/wo_long.jpg') }}" alt="Wo Long">
                            <p>WO LONG</p>
                            <p>$4.75</p>
                        </li>
                    </ul>
                </div>
                <button class="carousel-button next" data-carousel="new-releases">&gt;</button>
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
