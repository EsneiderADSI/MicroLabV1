@extends('layout')
@section('title', 'Módulo 1 - MicroLab')
<style>
body {
    background-image: url('assets/images/fondo-practica.webp'); /* Ruta de tu imagen */
    background-repeat: no-repeat; /* Evita que la imagen se repita */
    background-attachment: fixed; /* Hace que la imagen se quede fija en su lugar */
    background-size: cover; /* Ajusta la imagen para cubrir toda el área del body */
    background-position: center; /* Centra la imagen en la pantalla */
    margin: 0; /* Elimina el margen del body para evitar scroll innecesario */
    height: 100vh; /* Asegura que el body tenga una altura de 100% de la ventana */
}

</style>
@section('content')
<div class="container">
    <h1 class="mt-5">Práctica #1 </h1>
    <p class="">ADN Y ARN Conocélos aquí. <a href="/doc">sticky</a></p>

  </div>

    <div class="container" style="width: 90%;">


        <!-- Añadimos margen inferior al primer row o margen superior al segundo row -->
        <div class="row "> <!-- Aquí puedes ajustar el valor mb-* según necesites -->
            <div class="col-lg-6" style="border: ;">
                    <div class="image-container" id="mesa" style="z-index: 999;">
                    	<p>Arastrar aquí.</p>
                        <img src="{{ asset('assets/modulos/mesa-1.png') }}" alt="Mesa" style="z-index: -999;">
                    </div>

            </div>
            <div class="col-lg-3">
			<div class="ui-widget-content draggable">
			  <img src="{{ asset('assets/modulos/practica1/agua.png') }}" alt="Agua" width="50px">
			</div>
			<div class="ui-widget-content draggable">
			  <img src="{{ asset('assets/modulos/practica1/tester.png') }}" alt="Agua" width="50px">
			</div>

			<div class="ui-widget-content draggable">
			  <img src="{{ asset('assets/modulos/practica1/atom.png') }}" alt="Agua" width="50px">
			</div>
			<div class="ui-widget-content draggable">
			  <img src="{{ asset('assets/modulos/practica1/chemicals.png') }}" alt="Agua" width="50px">
			</div>
            </div>

            <div class="col-lg-3">
            	<div class="ui-widget-content draggable">
			  		<img src="{{ asset('assets/modulos/practica1/chemicals.png') }}" alt="Agua" width="50px">
				</div>

				<div class="ui-widget-content draggable">
			  		<img src="{{ asset('assets/modulos/practica1/science.png') }}" alt="Agua" width="50px">
				</div>
            </div>
        </div>

        <!-- Otra fila con margen superior -->
        <div class="row mt-4"> <!-- mt-4 añade más espacio arriba de esta fila -->
            <!-- Aquí puedes colocar más contenido -->
            <div class="col-lg-12">
                <p>Mueva los materiales hacia la mesa.</p>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
 <script>
  $( function() {
    $( ".draggable" ).draggable();
    $( "#mesa" ).droppable({
      drop: function( event, ui ) {
        $( this )
          .addClass( "ui-state-highlight" )
          .find( "p" )
            .html( "Soltado!" );
      }
    });
  } );
  </script>
@endsection
