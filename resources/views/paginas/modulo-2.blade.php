<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio Virtual con MaterializeCSS</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/mi.css') }}">
</head>

<body style="cursor: auto;">
    <div class="container-fluid">

        <div class="sidebar col-sm-3">
            <h5>Materiales</h5>
            <div class="divider"></div>
            	<p>Erlenmeyer</p>
                @include('paginas.modulo-1-objetos.erlenmeyer')
            	<div class="divider"></div>
            	<p>Frasco</p>
                @include('paginas.modulo-1-objetos.frasco')
            	<div class="divider"></div>
            	<p>Reactivos</p>
                @include('paginas.modulo-1-objetos.reactivos')
            	<div class="divider"></div>
            	<p>Medios de Cultivo</p>
                @include('paginas.modulo-1-objetos.medios_de_cultivo')
            	<div class="divider"></div>
            	<p>Microorganismos</p>
                @include('paginas.modulo-1-objetos.microorganismos')
            	<div class="divider"></div>
            	<p>Asa</p>
                @include('paginas.modulo-1-objetos.asa')
                @include('paginas.modulo-1-objetos.asa2')
            	<div class="divider"></div>
            	<p>Espátula</p>
                @include('paginas.modulo-1-objetos.espatula')
            	<p></p>
            	<div class="divider"></div>
            	<p>Placa Petri</p>
                @include('paginas.modulo-1-objetos.placa-petri')
            	<p></p>
            	<div class="divider"></div>
            	<p>Porta/Cubre Objetos</p>
                @include('paginas.modulo-1-objetos.portaobjetos')
                @include('paginas.modulo-1-objetos.cubreobjetos')

        </div>
        <!-- Espacio de trabajo central -->
        <div class="workspace col-md-6">
            <div class="workspace-inner">
                <p class="text-bold">TÉCNICAS BÁSICAS DE LABORATORIO PARA EL ESTUDIO DE LOS MICROORGANISMOS</p>
<ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3"><a class="active" href="#parte1">parte 1</a></li>
    <li class="tab col s3"><a href="#parte2">parte 2</a></li>
    <li class="tab col s3"><a href="#parte3">parte 3</a></li>
    <li class="tab col s3"><a href="#parte4">parte 4</a></li>
    <li class="tab col s3"><a href="#parte5">parte 5</a></li>
    <li class="tab col s3"><a href="#parte6">parte 6</a></li>
    <li class="tab col s3"><a href="#parte7">parte 7</a></li>
</ul>

<div id="parte1" class="col s12 agrupador">
		    <div class="image-container" id="mesa">
		        <p>Arrastrar aquí.</p>
		        <img src="{{ asset('assets/modulos/mesa-1.png') }}" alt="Mesa">
		    </div>
</div>
<div id="parte2" class="col s12 agrupador">
    <p>Contenido del parte 2</p>
</div>
<div id="parte3" class="col s12 agrupador">
    <p>Contenido del parte 3</p>
    <div class="divider"></div>
    <p>Hacer</p>

</div>
<div id="parte4" class="col s12 agrupador">
    <p>Contenido del parte 4</p>
</div>
<div id="parte5" class="col s12 agrupador">
    <p>Contenido del parte 5</p>
</div>
<div id="parte6" class="col s12 agrupador">
    <p>Contenido del parte 6</p>
</div>
<div id="parte7" class="col s12 agrupador">
    <p>Contenido del parte 7</p>
</div>

            </div>
        </div>
        <!-- Sidebar derecha -->
        <div class="sidebar col-sm-3">
            <h5>Herramientas</h5>
            <!-- Aquí puedes agregar herramientas adicionales o configuraciones -->
            @include('paginas.modulo-1-objetos.balanza')
            @include('paginas.modulo-1-objetos.phmetro')
            @include('paginas.modulo-1-objetos.mechero')
            @include('paginas.modulo-1-objetos.plancha-calentamiento')
            @include('paginas.modulo-1-objetos.autoclave')
            @include('paginas.modulo-1-objetos.cabina-de-flujo')
            @include('paginas.modulo-1-objetos.incubadora')

        </div>

    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/mi.js') }}"></script>
    <script>

$(document).ready(function() {
    var elems = document.querySelectorAll('.tabs');
    var instances = M.Tabs.init(elems);
    // Función para inicializar elementos redimensionables
    function initializeResizable(element) {
        let $element = $(element);
        $element.data('scale-factor', 1);
        $element.data('min-scale', 0.5);
        $element.data('max-scale', 1.5);
        $element.data('original-width', $element.width());
        $element.data('original-height', $element.height());

        $element.resizable({
            aspectRatio: true,
            handles: "all",
            start: function(event, ui) {
                $(this).data('start-scale', $(this).data('scale-factor'));
            },
            resize: function(event, ui) {
                let originalWidth = $(this).data('original-width');
                let originalHeight = $(this).data('original-height');
                let startScale = $(this).data('start-scale');
                let scaleFactor = ui.size.width / originalWidth;
                let newScale = startScale * scaleFactor;
                let minScale = $(this).data('min-scale');
                let maxScale = $(this).data('max-scale');
                newScale = Math.max(minScale, Math.min(maxScale, newScale));
                let newWidth = originalWidth * newScale;
                let newHeight = originalHeight * newScale;
                $(this).css({
                    transform: `scale(${newScale})`,
                    transformOrigin: 'top left'
                });
                ui.size.width = newWidth / newScale;
                ui.size.height = newHeight / newScale;
                $(this).data('scale-factor', newScale);
            },
            stop: function(event, ui) {
                $(this).css({
                    width: $(this).data('original-width') + 'px',
                    height: $(this).data('original-height') + 'px'
                });
            }
        });
    }

    // Inicializar elementos arrastrables
    $(".draggable").draggable({
        helper: function() {
            let clone = $(this).clone();
            clone.removeClass('ui-resizable');
            // Eliminar los manejadores de redimensionamiento
            clone.find('.ui-resizable-handle').remove();
            return clone;
        },
        appendTo: "body",
        zIndex: 1000,
        start: function(event, ui) {
            $(ui.helper).css('width', $(this).width());
        }
    });

    // Hacer que el espacio de trabajo acepte elementos arrastrables
    $(".workspace-inner").droppable({
        accept: ".draggable",
        drop: function(event, ui) {
            let droppedElement = $(ui.helper).clone();
            droppedElement.removeClass('draggable ui-draggable ui-draggable-handle resizable-element')
                          .addClass('dropped');

            // Eliminar cualquier manejador de redimensionamiento restante
            droppedElement.find('.ui-resizable-handle').remove();

            // Desactivar la funcionalidad de redimensionamiento si existe
            if (droppedElement.hasClass('ui-resizable')) {
                droppedElement.resizable('destroy');
            }

            droppedElement.css({
                position: 'absolute',
                left: ui.position.left - $(this).offset().left,
                top: ui.position.top - $(this).offset().top
            });
            $(this).append(droppedElement);

            // Hacer que el elemento clonado sea arrastrable dentro del workspace
            droppedElement.draggable({
                containment: "parent"
            });
        }
    });

    // Inicializar elementos redimensionables existentes
    $(".resizable-element").each(function() {
        initializeResizable(this);
    });

    // ... (resto del código para scroll y tabs)


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


    // Llenar el frasco de agua
        $(document).on('click', '.vaso', function(event){
            const agua = $(this).find('#agua_vaso');
        if (agua.css('height') === '40px') {
            // Si está lleno, vaciarlo
            agua.css('height', '0');
        } else {
            // Si está vacío, llenarlo
            agua.css('height', '40px');
        }
        });


    $(document).on('click', '.dropped', function(event){
        if (event.ctrlKey) {
            // Mostrar alerta de confirmación
            if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
                // Destruir el objeto si se acepta
                $(this).remove();
            }
        }
    });


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

});


    </script>
</body>

</html>