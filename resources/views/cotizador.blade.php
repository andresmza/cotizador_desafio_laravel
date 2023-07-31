<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cotizador</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.css">
    <script src="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>



    <script src="{{ asset('js/cotizador.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container text-center py-1 d-block d-md-flex justify-content-between">
        <img src="https://www.mailexpress.com.ar/img/mailex-logo.png">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown ml-4">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <b>SERVICIOS</b>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><b>SEGUIMIENTO</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><b>SUCURSALES</b></a>
                </li>
            </ul>
        </div>

        <div class="ml-auto">
            <button type="button" class="btn btn-red"><b>COTIZADOR</b></button>
            <button type="button" class="btn btn-login"><b>Iniciar sesión</b></button>
        </div>
    </div>
</nav>


    <div class="custom-container">
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <h3 class="font-rounded mt-4">CALCULÁ TU ENVÍO</h3>

                <p class="text-secondary mt-4"><strong>Ingresá las dimensiones y el peso de tu paquete para calcular el
                        costo del envío.</strong></p>

                <form id="formCotizador">
                    <div class="row mb-3 mt-4">
                        <div class="col">
                            <label for="cp_origen" class="form-label"><b>CP Origen</b></label>
                            <input type="number" class="form-control" id="cp_origen" name="cp_origen"
                                placeholder="Ej: 5500" required>
                        </div>
                        <div class="col">
                            <label for="cp_destino" class="form-label"><b>CP Destino</b></label>
                            <input type="number" class="form-control" id="cp_destino" name="cp_destino"
                                placeholder="Ej: 5500" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="kilos" class="form-label"><b>Kilos</b></label>
                            <input type="number" class="form-control" id="kilos" name="kilos"
                                placeholder="Ej: 5 kg" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-center mt-4">
                            <button type="submit" class="btn btn-red btn-width-25"><b>Cotizar</b></button>
                        </div>
                    </div>

                </form>
                <img src="https://www.mailexpress.com.ar/img/mailex-puntos.png"" class="fixed-image">

            </div>
            <div class="col-md-6">
                <img src={{ asset('storage/image.png') }} class="img-fluid">
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalCotizador" tabindex="-1" aria-labelledby="modalCotizadorLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-30">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="m-title">TU COSTO DE ENVÍO ES: <span id="monto" class="text-danger"></span></h2>
                    <hr class="my-4">
                    <p class="text-secondary">De <span id="origen"></span> a <span id="destino"></span>.</p>
                    <p class="text-secondary">Peso: <span id="peso"></span> kg.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modal" data-bs-dismiss="modal"><b>Aceptar</b></button>
                </div>
            </div>
        </div>
    </div>


     <footer class="footer">
        <div class="container">
            <div class="row">
                  <div class="text-center py-1 d-block d-md-flex justify-content-between">
                    <div class="d-flex flex-md-column">
                      <p class="roboto-font mt-3 my-md-auto">©2022 MailEx. Todos los derechos reservados</p>
                    </div>
                    <div class="d-flex flex-md-column">
                      <a href="https://www.enacom.gob.ar/tramites/servicios-postales-reclamos_t11"
                         class="my-md-auto text-white fw-light me-auto">ENACOM</a>
                    </div>
                    <div class="d-flex flex-md-column">
                      <p class="roboto-font mt-3 mb-4 my-md-auto ms-auto">Sitio desarrollado por <a
                         href="https://www.mydesign.com.ar/" class="text-white" target="_blank"><img
                         src="https://www.mailexpress.com.ar//img/mydesign-logo.png" alt="MyDesign"></a></p>
                    </div>
                  </div>
            </div>
        </div>
    </footer> 

</html>
