<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modulos</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles-banner.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- <header>
        <div class="logo">YOUR LOGO</div>
        <nav>
            <a href="#">HOME</a>
            <a href="#">CONTACT</a>
            <a href="#">GALLERY</a>
            <a href="#">PHOTOS</a>
        </nav>
    </header> -->
    <main>
        <section class="hero">
            <div class="container">
                <div class="row">
                  <div class="col" style="z-index: 1000;">
                    <h3><span class="highlight">@if(Auth::check()){{ Auth::user()->nombres }} {{ Auth::user()->apellidos }}!@endif </span> </h3>
                    <div class="container my-5">
                        <a style="text-decoration: none;" href="{{ route('modulo1') }}">
                        <div class="row card-custom">
                            <div class="col-md-6 bg-red text-white p-5 d-flex flex-column justify-content-between">
                                <div>
                                    <h5>Práctica # 1</h5>
                                </div>
                            </div>
                            <div class="col-md-6 p-5 d-flex flex-column justify-content-between bg-light-blue position-relative">
                                <img src="{{ asset('assets/images/svg/modulos/bitrina1.svg') }}" alt="Lab Image" class="img-fluid">
                            </div>
                        </div>
                        </a>
                        <br>
                        <a style="text-decoration: none;" href="{{ route('modulo2') }}">
                        <div class="row card-custom">
                            <div class="col-md-6 bg-yelow text-white p-5 d-flex flex-column justify-content-between">
                                <div>
                                    <h5>Práctica # 2</h5>
                                </div>
                            </div>
                            <div class="col-md-6 p-5 d-flex flex-column justify-content-between bg-light-blue position-relative">
                                <img src="{{ asset('assets/images/svg/modulos/bitrina1.svg') }}" alt="Lab Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    </a>
                  </div>
                  <div class="col" style="margin-top: 150px; z-index: 1000;">
                    <div class="recuadro-texto">
                        <p>MÓDULOS</p>
                    </div>
                  </div>
                  <div class="col" style="z-index: 1000;">
                    <div class="container my-5">
                        <a style="text-decoration: none;" href="{{ route('modulo3') }}">
                        <div class="row card-custom">
                            <div class="col-md-6 bg-orange text-white p-5 d-flex flex-column justify-content-between">
                                <div>
                                    <h5>Práctica # 3</h5>
                                </div>
                            </div>
                            <div class="col-md-6 p-5 d-flex flex-column justify-content-between bg-light-blue position-relative">
                                <img src="{{ asset('assets/images/svg/modulos/bitrina1.svg') }}" alt="Lab Image" class="img-fluid">
                            </div>
                        </div>
                        </a>

                        <br>
                        <div class="row card-custom">
                            <div class="col-md-6 bg-dark2 text-white p-5 d-flex flex-column justify-content-between">
                                <div>
                                    <h5>Práctica # 4</h5>
                                </div>
                                {{-- <div>
                                    <a href="#" class="btn btn-light btn-lg">LEARN MORE</a>
                                </div> --}}
                            </div>
                            <div class="col-md-6 p-5 d-flex flex-column justify-content-between bg-light-blue position-relative">
                                <img src="{{ asset('assets/images/svg/modulos/bitrina1.svg') }}" alt="Lab Image" class="img-fluid">
                            </div>
                        </div>
                    </div>

                  </div>
                </div>
              </div>



        </section>

        <div class="contenedor-graficos">

            <div class="scientist">
                <img src="{{ asset('assets/images/svg/nubes-fig3.svg') }}" alt="Scientist">
            </div>

            <div class="recuadro">
                <div class="container text-center">
                    <div class="row">
                      <div class="col">
                        <div class="gafas">
                            <img src="{{ asset('assets/images/svg/gafas.svg') }}" alt="Scientist">
                        </div>
                      </div>
                      <div class="col">
                        <div class="quimico1">
                            <img src="{{ asset('assets/images/svg/quimico1.svg') }}" alt="Scientist">
                        </div>
                      </div>
                      <div class="col">
                        <div class="petri">
                            <img src="{{ asset('assets/images/svg/quimico3.svg') }}" alt="Scientist">
                        </div>
                      </div>
                      <div class="col">
                        <div class="microscopio">
                            <img src="{{ asset('assets/images/svg/microscopio.svg') }}" alt="Scientist">
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>


    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
