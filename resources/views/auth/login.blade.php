<!doctype html>
<html lang="es">
  <head>
    <title>Iniciar Sesión</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('assets/estilos.css') }}" />
  </head>

  <body>
    <section class="h-100 gradient-form" style="background-color: #f0e4e4; background-image: url('{{asset('images/Fondo1.jpg')}}'); background-size: cover; background-position: center; background-repeat: no-repeat; min-height: 100vh;">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-xl-10 col-lg-12">
            <div class="card rounded-3 text-black" style="background-color: rgba(255, 255, 255, 0.6); margin-top: 50px;"> <!-- Ajusta el margin-top para mover el contenedor hacia abajo -->
              <div class="row g-0">
                <div class="col-lg-6 d-flex align-items-center">
                  <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">
                      <h4 class="mt-1 mb-5 pb-1">Iniciar Sesión</h4>
                    </div>

                    <form action="{{route('login')}}" method="post">
                      @csrf
                      <p class="text-center">INICIAR SESIÓN</p>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example11">Correo</label>  
                        <input type="email" name="email" id="form2Example11" class="form-control" placeholder="Ingresar Correo" />
                      </div>

                      <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example22">Contraseña</label>  
                        <input type="password" name="password" id="form2Example22" class="form-control" placeholder="Ingresar Contraseña" />
                      </div>

                      <div class="text-center pt-1 mb-5 pb-1">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Ingresar</button>
                        <a class="text-muted" href="#!">¿Olvidaste tu contraseña?</a>
                      </div>

                      <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">¿No tienes cuenta?</p>
                        <a href="{{route('register')}}" class="btn btn-outline-danger">Crear Cuenta</a>
                      </div>

                    </form>

                  </div>
                </div>
                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                  <div class="text-white px-3 py-4 p-md-5 mx-md-4 text-center">
                    <img src="{{asset('images/Logo1.jpg')}}"
                         style="width: 100%; max-width: 350px; height: auto; border-radius: 50%; box-shadow: 0px 4px 15px rgba(156, 131, 164, 0.1); object-fit: cover;"
                         alt="logo">
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
