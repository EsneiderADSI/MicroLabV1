@extends('layout')
@section('title', 'Módulo 2 - MicroLab')
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
    <h1 class="mt-5">Práctica #2 </h1>
    <p class="">ADN Y ARN Conocélos aquí. <a href="/modulos">Volver al inicio</a></p>

  </div>
 	<div class="container-fluid custom-padding">


        <!-- Añadimos margen inferior al primer row o margen superior al segundo row -->
        <div class="row "> <!-- Aquí puedes ajustar el valor mb-* según necesites -->
		<div class="col-lg-6" style="pointer-events: none;">
		    <div class="image-container" id="mesa">
		        <p>Arrastrar aquí.</p>
		        <img src="{{ asset('assets/modulos/mesa-2.png') }}" alt="Mesa">
		    </div>
		</div>


            <div class="col-lg-2">
			<div class="ui-widget-content draggable" id="agua">
			  <img src="{{ asset('assets/modulos/practica1/agua.png') }}" alt="agua" width="50px">
			</div>
			<div class="ui-widget-content draggable" id="azucar">
			  <img src="{{ asset('assets/modulos/practica1/tester.png') }}" alt="azucar" width="50px">
			</div>

			<div class="ui-widget-content draggable" id="aceite">
			  <img src="{{ asset('assets/modulos/practica1/atom.png') }}" alt="aceite" width="50px">
			</div>
			<div class="ui-widget-content draggable" id="sal">
			  <img src="{{ asset('assets/modulos/practica1/chemicals.png') }}" alt="sal" width="50px">
			</div>
            </div>

            <div class="col-lg-2">
            	<div class="ui-widget-content draggable" id="Agua">
			  		<img src="{{ asset('assets/modulos/practica1/flask.png') }}" alt="Agua" width="50px">
				</div>

				<div class="ui-widget-content draggable">
			  		<img src="{{ asset('assets/modulos/practica1/science.png') }}" alt="Agua" width="50px">
				</div>
            </div>

            <div class="col-lg-2">
            	<h3>Hoy</h3>
            	<p>CL NA 134 gr 5%</p>
            	<p>BR BAD 43 gr 5%</p>
            </div>
        </div>

        <!-- Otra fila con margen superior -->
        <div class="row mt-4"> <!-- mt-4 añade más espacio arriba de esta fila -->
            <!-- Aquí puedes colocar más contenido -->
            <div class="col-lg-12">
                <p id="alerta">Mueva los materiales hacia la mesa.</p>
            </div>
        </div>
    </div>
@endsection

@section('extra_js')
 <script>
    $(document).ready(function() {

    $( ".draggable" ).draggable();

	     $("#mesa").droppable({
	         tolerance: 'fit',
	         drop: function(e, ui) {
	             if (ui.draggable.attr('id') == 'agua') {
						let value = parseFloat(prompt("¿Cuánta agua vas a utilizar? ml", "10"));
						if (!isNaN(value)) {
						    $("#alerta").html("Has aplicado " + value + " ml a la mezcla");
						} else {
						    $("#alerta").html("Por favor, introduce un número válido.");
						}
	             }
	         },
	        over: function(event, ui) {
	          $( this ).addClass( "ui-state-highlight" ).find( "p" ).html( "Cerca!" );
	        	if (ui.draggable.attr('id') == 'xxxxxxxxxxxx') { }
	        },
	        out: function(event, ui) {
	         $( this ).addClass( "ui-state-highlight" ).find( "p" ).html( "Lejos!" );
	        }
	     });

  });
  </script>
@endsection
