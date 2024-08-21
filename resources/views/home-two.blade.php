<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
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

                {{-- <div class="imagen-fija">
                    <img src="{{ asset('assets/images/svg/gr4.svg') }}" alt="Scientist">
                </div> --}}

            <div class="container text-center">
                <div class="row">
                  <div class="col">

                  </div>
                  <div class="col" style="margin-top: 100px; z-index: 1000;">
                    <div>
                        <h1><span class="highlight">BIENVENIDOS A</span> MICROLAB</h1>
                        <p class="subtitle">Laboratorio Microbiológico Virtual</p>
                        {{-- <p class="description">Lorem ipsum dolor sit amet, consectetuer adipiing elit, sed diam nonummy nibh euismod tincd.</p> --}}
                        <div class="button-container">
                            <a href="{{ route('modulos') }}" class="button">EMPEZAR</a>
                        </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="bitrina">
                        <img src="{{ asset('assets/images/svg/bitrina.svg') }}" alt="Scientist">
                    </div>

                  </div>
                </div>
              </div>



        </section>

        <div class="contenedor-graficos">
            <div class="doctor">
                <img src="{{ asset('assets/images/svg/doctor2.svg') }}" alt="Scientist">
            </div>
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
