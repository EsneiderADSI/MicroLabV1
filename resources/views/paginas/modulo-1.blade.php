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
        <p>Contenido del parte 1</p>
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
            @include('paginas.modulo-1-objetos.microscopio')
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
  // Función para manejar el z-index y la posición de los elementos
    function handleZIndexAndPosition(element) {
        if (element.hasClass('vaso')) {
            element.css('z-index', 900);
        } else if (element.hasClass('medio_cultivo')) {
            element.css('z-index', 999);
        }
        // Puedes agregar más condiciones para otros tipos de elementos si es necesario
    }


// Objeto para llevar el conteo de elementos agregados
const elementCounter = {};

// Configuración de elementos aceptados por cada contenedor
const acceptedElements = {
  'workspace-inner': ['vaso', 'erlenmeyer', 'petridish', 'plancha-container', 'reactivo', 'microorganismo', 'mechero-container'],
  'vaso': ['medio_cultivo', 'phmetro', 'microorganismo'],
  'plancha-container': ['vaso'],
  'erlenmeyer': ['solucion', 'reactivo'],
  'petridish': ['agar', 'microorganismo'],
  'mechero-container': ['vaso']
};
$(".draggable").draggable({
  helper: function() {
    let clone = $(this).clone();
    clone.removeClass('ui-resizable');
    clone.find('.ui-resizable-handle').remove();
    return clone;
  },
  appendTo: "body",
  zIndex: 1000,
  start: function(event, ui) {
    $(ui.helper).css('width', $(this).width());
  }
});

var agregados = [];
// Función para hacer un elemento droppable
function makeDroppable(element) {

  element.droppable({
    tolerance: 'touch',
    accept: function(draggable) {
      let elementClass = element.attr('class').split(' ')[0];
      let draggableClass = draggable.attr('class').split(' ')[0];
      return acceptedElements[elementClass] && acceptedElements[elementClass].includes(draggableClass);
    },
    over: function(event, ui) {
      $(this).addClass('droppable-highlight');
    },
    out: function(event, ui) {
      $(this).removeClass('droppable-highlight');
    },
    drop: function(event, ui) {
      $(this).removeClass('droppable-highlight');


      let droppedElement = $(ui.helper).clone();
      let elementType = ui.draggable.attr('class').split(' ')[0]; // Usamos la clase del elemento original
      let dropTarget = $(this);

      // Verificar si ya se ha agregado el elemento máximo permitido (solo para workspace-inner)


      droppedElement.removeClass('draggable ui-draggable ui-draggable-handle resizable-element')
        .addClass('dropped')
        .addClass(elementType); // Mantenemos la clase original del elemento

      droppedElement.find('.ui-resizable-handle').remove();

      if (droppedElement.hasClass('ui-resizable')) {
        droppedElement.resizable('destroy');
      }

      let offsetX = ui.offset.left - dropTarget.offset().left;
      let offsetY = ui.offset.top - dropTarget.offset().top;

      droppedElement.css({
        position: 'absolute',
        left: offsetX,
        top: offsetY
      });

      // handleZIndexAndPosition(droppedElement);
      eliminarElementosIguales(droppedElement);
      dropTarget.append(droppedElement);

      droppedElement.draggable({
        containment: "parent",
        start: function(event, ui) {
          $(this).css('z-index', getMaxZIndex() + 1);
        }
      });

      // Hacer droppable si el elemento es un contenedor
      if (acceptedElements[elementType]) {
        makeDroppable(droppedElement);
      }

      // Detectar combinaciones específicas
      detectSpecificCombination(droppedElement, dropTarget);
    }
  });
}

// Función para detectar combinaciones específicas
function detectSpecificCombination(droppedElement, dropTarget) {
  let droppedType = droppedElement.attr('class').split(' ').find(cls => acceptedElements[dropTarget.attr('class').split(' ')[0]].includes(cls));
  let targetType = dropTarget.attr('class').split(' ')[0];

  console.log(`${droppedType} se soltó sobre ${targetType}`);

  // Acciones específicas basadas en la combinación
  switch(targetType) {
    case 'workspace-inner':
      handleWorkspaceInteraction(droppedType);
      break;
    case 'vaso':
      handleVasoInteraction(droppedType);
      break;
    case 'erlenmeyer':
      handleErlenmeyerInteraction(droppedType);
      break;
    case 'plancha-container':
      handlePlanchaInteraction(droppedType);
      break;
    // Agrega más casos según sea necesario
  }
}

function handleWorkspaceInteraction(elementType) {
  switch(elementType) {
    case 'vaso':
      console.log('Vaso añadido al workspace. Inicializando...');
      // Lógica específica para vaso en workspace
      break;
    case 'erlenmeyer':
      console.log('Erlenmeyer añadido al workspace. Configurando...');
      // Lógica específica para erlenmeyer en workspace
      break;
    case 'plancha-container':
      console.log('Plancha añadida al workspace. Preparando...');
      // Lógica específica para placa de Petri en workspace
      break;
    // Más casos según sea necesario
  }
}

function handleVasoInteraction(elementType) {
  switch(elementType) {
    case 'medio_cultivo':
      console.log('Medio de cultivo añadido al vaso. Mezclando...');
      // Lógica para medio de cultivo en vaso
      break;
    case 'plancha-container':
      console.log('pHmetro introducido en el vaso. Midiendo pH...');
      // Lógica para pHmetro en vaso
      break;
    case 'microorganismo':
      console.log('Microorganismo añadido al vaso. Iniciando cultivo...');
      // Lógica para microorganismo en vaso
      break;
  }
}

function handleErlenmeyerInteraction(elementType) {
  // Implementa la lógica específica para interacciones con el erlenmeyer
  console.log(`${elementType} añadido al erlenmeyer.`);
}

function handlePlanchaInteraction(elementType) {
  // Implementa la lógica específica para interacciones con la placa de Petri
  console.log(`${elementType} añadido a la PLANCHA.`);
}

// Función para manejar el z-index y la posición
function handleZIndexAndPosition(element) {
  let maxZIndex = getMaxZIndex();
  element.css('z-index', maxZIndex + 1);
}

// Función para obtener el máximo z-index actual
function getMaxZIndex() {
  return Math.max(0, ...$('.dropped').map(function() {
    return parseInt($(this).css('z-index')) || 0;
  }));
}

// Hacer que el espacio de trabajo y los contenedores sean droppables
$(".workspace-inner, .vaso, .erlenmeyer, .petridish, .plancha-container").each(function() {
  makeDroppable($(this));
});

// Inicializar elementos redimensionables existentes
$(".resizable-element").each(function() {
  initializeResizable(this);
});

// Agregar estilos para el highlight
$("<style>")
  .prop("type", "text/css")
  .html(`
    .droppable-highlight {
      box-shadow: 0 0 10px #007bff;
      transition: box-shadow 0.3s ease;
    }
  `)
  .appendTo("head");



    function eliminarElementosIguales(elemento) {
        // Seleccionamos todos los elementos iguales dentro de .workspace-inner
        const elementosIguales = $('.workspace-inner').find($(elemento).prop('tagName').toLowerCase() + '.' + $(elemento).attr('class').split(' ').join('.'));

        // Eliminamos todos los elementos iguales excepto el elemento original
        elementosIguales.each(function() {
            if (this !== elemento) {
                $(this).remove();
            }
        });
    }
        function LlenarBotellas(){
            $('.reactivo').each(function() {
                const liquido_botella = $(this).find('.liquido_botella');
                liquido_botella.css('height', '40px');
            });
        }
        LlenarBotellas();

        $(document).on('click', '.reactivo', function(event){
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
            if ($(this).hasClass('jhancarlos_agregado')) {
                // Aquí puedes agregar el código que deseas ejecutar si tiene la clase
                alert('El vaso tiene la clase jhancarlos_agregado');
                const medio_cultivo = $(this).find('.medio_cultivo');
                medio_cultivo.css('height', '100px');
                medio_cultivo.css('width', '100px');
                medio_cultivo.css('background-color', '#9b59b6');
            }

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


         $(".vaso").droppable({
             tolerance: 'fit',
             accept: ".medio_cultivo",
             drop: function(e, ui) {
                alert("arroz");
                 if (ui.draggable.attr('tipo') == 'medio_cultivo') {
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

         $(".balanza").droppable({
             tolerance: 'intersect',
             drop: function(e, ui) {
                 if (ui.draggable.attr('tipo') == 'medio_cultivo') {
                    var balanza = $(this);
                    let width = ui.draggable.width();
                    let height = ui.draggable.height();

                    let weight = balanza.find(".display_balanza").attr("value"); // Acceder al atributo value

                    ui.draggable.text(weight + "g").attr("value", weight);
                 }
             },
            out: function(event, ui) {
                var balanza = ui.draggable;
                balanza.find(".display_balanza").text("0g").attr('value', '0');
            }
         });

         $(document).on('input', '.peso_slider', function(event){
                const $balanza = $(this).closest('.balanza');
                const value = $(this).val();
                $balanza.find('.display_balanza').text(value + 'g').attr('value', value);
            });

});


    </script>
</body>

</html>