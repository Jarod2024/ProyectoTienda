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

            <button class="button_github">
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M12 0.296997C5.37 0.296997 0 5.67 0 12.297C0 17.6 3.438 22.097 8.205 23.682C8.805 23.795 9.025 23.424 9.025 23.105C9.025 22.82 9.015 22.065 9.01 21.065C5.672 21.789 4.968 19.455 4.968 19.455C4.422 18.07 3.633 17.7 3.633 17.7C2.546 16.956 3.717 16.971 3.717 16.971C4.922 17.055 5.555 18.207 5.555 18.207C6.625 20.042 8.364 19.512 9.05 19.205C9.158 18.429 9.467 17.9 9.81 17.6C7.145 17.3 4.344 16.268 4.344 11.67C4.344 10.36 4.809 9.29 5.579 8.45C5.444 8.147 5.039 6.927 5.684 5.274C5.684 5.274 6.689 4.952 8.984 6.504C9.944 6.237 10.964 6.105 11.984 6.099C13.004 6.105 14.024 6.237 14.984 6.504C17.264 4.952 18.269 5.274 18.269 5.274C18.914 6.927 18.509 8.147 18.389 8.45C19.154 9.29 19.619 10.36 19.619 11.67C19.619 16.28 16.814 17.295 14.144 17.59C14.564 17.95 14.954 18.686 14.954 19.81C14.954 21.416 14.939 22.706 14.939 23.096C14.939 23.411 15.149 23.786 15.764 23.666C20.565 22.092 24 17.592 24 12.297C24 5.67 18.627 0.296997 12 0.296997Z" fill="white"></path>
  </svg>
  <p class="text_github">Click me</p>
</button>

            <div class="light-button">
                <button class="bt">
                    <div class="light-holder">
                    <div class="dot"></div>
                    <div class="light"></div>
                    </div>
                    <div class="button-holder">
                        <img src="{{ asset('images/instagram.png') }}" alt="Custom Image" />
                    <p>Instagram</p>
                    </div>
                </button>
            </div>


            <button class="Btn">
                <span class="imageContainer">
                    <img src="{{ asset('images/instagram.png') }}" alt="Custom Image" class="customImage">
                </span>
                <span class="BG"></span>
            </button>


        </div>
        
    </footer>
    <!-- Enlaza el archivo JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
