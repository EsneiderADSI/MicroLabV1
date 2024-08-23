@extends('layout')
@section('title', 'Módulo 1 - MicroLab')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="pointer-events: none;">
    <h1 class="mt-5">Práctica #1 </h1>
    <p class="">ADN Y ARN Conocélos aquí. <a href="/modulos">Volver al inicio</a></p>
        </div>

    </div>


  </div>
 	<div class="container-fluid custom-padding">


        <!-- Añadimos margen inferior al primer row o margen superior al segundo row -->
        <div class="row "> <!-- Aquí puedes ajustar el valor mb-* según necesites -->
		<div class="col-lg-6" style="pointer-events: none;">
		    <div class="image-container" id="mesa">
		        <p>Arrastrar aquí.</p>
		        <img src="{{ asset('assets/modulos/mesa-1.png') }}" alt="Mesa">
		    </div>
		</div>

        <div class="col-lg-2">
            <div id="balanza" class="drag" description="Balanza">
                <div id="display_balanza">Peso: 0g</div>
                <div id="lamina_balanza" class="drag" description="Lámina de aluminio">LÁMINA</div>
            </div>
        </div>

            <div class="col-lg-4" style="border: 1px solid;">
                @include('paginas.modulo-1-objetos.reactivos')
                @include('paginas.modulo-1-objetos.espatula')
                @include('paginas.modulo-1-objetos.portaobjetos')
                @include('paginas.modulo-1-objetos.cubreobjetos')
                @include('paginas.modulo-1-objetos.incubadora')
                @include('paginas.modulo-1-objetos.frasco')
                @include('paginas.modulo-1-objetos.mechero')
                @include('paginas.modulo-1-objetos.medios_de_cultivo')
                @include('paginas.modulo-1-objetos.microorganismos')
                @include('paginas.modulo-1-objetos.plancha-calentamiento')
                @include('paginas.modulo-1-objetos.erlenmeyer')
                @include('paginas.modulo-1-objetos.phmetro')
                @include('paginas.modulo-1-objetos.cabina-de-flujo')
                @include('paginas.modulo-1-objetos.autoclave')
                @include('paginas.modulo-1-objetos.asa')


                <div class="petridish draggable drag" description="Placa de petri" width="50px"></div>
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


         $("#balanza").droppable({
             tolerance: 'intersect',
             drop: function(e, ui) {
                 if (ui.draggable.attr('tipo') == 'medio_cultivo') {
                    let width = ui.draggable.width();
                    let height = ui.draggable.height();

                    let weight = (width*height) / 10;
                    $("#display_balanza").text("Peso: " + weight + "g");
                    ui.draggable.text(weight + "g");
                 }
             },
            out: function(event, ui) {
             $("#display_balanza").text("Peso: 0g");
            }
         });
    // Llenar el frasco de agua
        $(document).on('dblclick', '#frasco', function(event){
            const agua = document.getElementById('agua');
            if (agua.style.height === '40%') {
                // Si está lleno, vaciarlo
                agua.style.height = '0';
            } else {
                // Si está vacío, llenarlo
                agua.style.height = '40%';
            }
        });

        function LlenarBotellas(){
            $('.botella').each(function() {
                const liquido_botella = $(this).find('.liquido_botella');
                liquido_botella.css('height', '40px');
            });
        }
        LlenarBotellas();

        $(document).on('click', '.botella', function(event){
            const liquido_botella = $(this).find('.liquido_botella');
            if (liquido_botella.css('height') === '40px') {
                // Si está lleno, vaciarlo
                liquido_botella.css('height', '0');
            } else {
                // Si está vacío, llenarlo
                liquido_botella.css('height', '40px');
            }
        });


    });

  </script>
@endsection



