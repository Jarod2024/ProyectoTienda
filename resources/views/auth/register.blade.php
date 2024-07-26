<!doctype html>
<html lang="es">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"/>
      <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}" />
      
  </head>

  <body>
    <section class="h-100 gradient-form" style="background-color: #b43b3b;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="{{asset('images/admin.jpg')}}"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">LOGIN</h4>
                </div>

                                <form action="{{route('register')}}" method="post">
                    @csrf
                    <p>REGISTRO</p>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="name">Nombre</label>  
                        <input type="text" name="name" id="name" class="form-control" placeholder="Ingresar nombre" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="year_of_birth">Fecha Nacimiento</label>  
                        <input type="date" name="year_of_birth" id="year_of_birth" class="form-control" placeholder="Ingresar fecha" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="phone_number">Teléfono</label>  
                        <input type="tel" name="phone_number" id="phone_number" class="form-control" placeholder="Ingresar teléfono" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="Direccion">Dirección</label>  
                        <input type="text" name="Direccion" id="Direccion" class="form-control" placeholder="Ingresar dirección" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="email">Correo</label>  
                        <input type="email" name="email" id="email" class="form-control" placeholder="Ingresar correo" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="password">Contraseña</label>  
                        <input type="password" name="password" id="password" class="form-control" />
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>  
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Registrarse</button>
                    </div>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Ir a Login</p>
                        <a href="{{route('login')}}" class="btn btn-outline-danger">Login</a>
                    </div>
                </form>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">BIENVENIDO ENTRETENIMIENTO GAMMING</h4>
                <p class="small mb-0">Bienvenido al nuestro rincón virtual de entretenimiento 
                  gamming donde la emoción y la aventura se fusionan. La personas amantes de los video 
                  juegos tenemos variedad de productos que les puede interesar y muchos juegos de estreno..</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>




    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
