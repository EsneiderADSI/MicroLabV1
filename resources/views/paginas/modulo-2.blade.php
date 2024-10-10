<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLab P2</title>
    <!-- Favicon para navegadores antiguos -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Favicon para navegadores modernos -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.ico') }}">
    <!-- Favicon para dispositivos Apple -->
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/mi.css') }}">
</head>

<body style="cursor: auto;">
<button id="exitButton" style="display:none;">Salir del Microscopio</button>
<div id="microscopeOverlay" style="display:none;"></div>
    <div class="container-fluid">

        <div class="sidebar col-sm-3  lime lighten-5">
            <h5>Materiales</h5>
            <div class="divider"></div>
                <p>Placa Petri</p>
                <div class="divider"></div>
                @include('paginas.objetos.practica2.placa-petri-p2')
                <div class="divider"></div>
                @include('paginas.objetos.practica2.placa-petri-preparada-p2')
                <p></p>
                <div class="divider"></div>
                <p>Lupa</p>
                @include('paginas.objetos.lupa')
                <p></p>
                <div class="divider"></div>
                <p>Reactivos</p>
                @include('paginas.objetos.reactivos')
                <div class="divider"></div>
                <p>Asa</p>
                @include('paginas.objetos.asa')
                @include('paginas.objetos.asa2')
                <div class="divider"></div>
                <p>Espátula</p>
                @include('paginas.objetos.espatula')
                <p></p>
                <div class="divider"></div>
                <p>Porta/Cubre Objetos</p>
                @include('paginas.objetos.portaobjetos')
                @include('paginas.objetos.cubreobjetos')

        </div>
        <!-- Espacio de trabajo central -->
        <div class="workspace col-md-6">
            <div id="parte1" class="workspace-inner lime lighten-4">
                <blockquote>PARASITOLOGÍA INTESTINAL <a style="font-size: 12px;" href="javascript:void(0)" class="disabled flow-text" id="coordinates"></a></blockquote>

                <p></p>
            </div>
        </div>
        <!-- Sidebar derecha -->
        <div class="sidebar col-sm-3  lime lighten-5">
            <h5>Herramientas</h5>
            <!-- Aquí puedes agregar herramientas adicionales o configuraciones -->
            @include('paginas.objetos.microscopio')
            @include('paginas.objetos.pipeta')
            @include('paginas.objetos.autoclave')
            @include('paginas.objetos.cabina-de-flujo')
            @include('paginas.objetos.incubadora')

        </div>

    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/mi.jsp2.js') }}"></script>
    <script>

$(document).ready(function() {
    // initializeWorkspaceDraggables();

    var elems = document.querySelectorAll('.tabs');
    var instances = M.Tabs.init(elems);
    // Función para inicializar elementos redimensionables
    function initializeResizable(element) {
        let $element = $(element);
        $element.data('scale-factor', 1);
        $element.data('min-scale', 0.5);
        $element.data('max-scale', 6);
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


// Configuración de elementos aceptados por cada contenedor
const acceptedElements = {
  'workspace-inner': ['balanza','vaso', 'medio_cultivo', 'erlenmeyer', 'petridish_p2', 'reactivo', 'microorganismo', 'mechero-container', 'autoclave-container', 'plancha-container', 'incubadora-container', 'cabina-container', 'phmetro', 'tubo-ensayo-container', 'portaobjetos', 'cubreobjetos', 'microscopio', 'asa1-container', 'asa2-container', 'petridish_pre_prac2','tubo-ensayo-container_micro', 'pipeta', 'lupa-container'],

  'petridish_p2': ['agar', 'microorganismo', 'vaso', 'asa1-container', 'pipeta', 'zoom'],
  'incubadora-container': ['petridish_p2'],
  'autoclave-container': ['vaso'],
  'erlenmeyer': ['medio_cultivo_caldo', 'reactivo', 'phmetro'],
  'tubo-ensayo-container': ['erlenmeyer'],
  'cabina-container': ['erlenmeyer'],
  'mechero-container': ['asa1-container', 'asa2-container'],
  'petridish_pre_prac2': ['asa1-container', 'asa2-container', 'lupa-container'],
  'tubo-ensayo-container_micro': ['pipeta'],
  'reactivo': ['pipeta'],
  'portaobjetos': ['pipeta', 'asa1-container'],
  'microscopio': ['portaobjetos'],
};

// Lista de elementos que deben permanecer fijos en su posición inicial cuándo se suelta en el workspace-inner
const fixedElements = ["autoclave-container", "incubadora-container", "mechero-container", "plancha-container", "cabina-container", "balanza"];

// Función para determinar dónde se debe agregar el elemento
function determineAppendTarget(draggableType, droppableType) {
  // Lista de combinaciones que deben agregarse al contenedor específico
  const appendToTargetCombinations = [
    { draggable: 'medio_cultivo', droppable: 'vaso' },
    { draggable: 'medio_cultivo_caldo', droppable: 'erlenmeyer' },
    { draggable: 'microorganismo', droppable: 'petridish_p2' },
    // { draggable: 'vaso', droppable: 'autoclave-container' }
    // Agrega aquí más combinaciones según sea necesario
  ];

  // Verifica si la combinación actual está en la lista
  const shouldAppendToTarget = appendToTargetCombinations.some(
    combo => combo.draggable === draggableType && combo.droppable === droppableType
  );

  // Retorna el contenedor apropiado
  return shouldAppendToTarget ? droppableType : 'workspace-inner';
}

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
    let elementType = $(this).attr('class').split(' ')[0];
    $("#parte1 p").html("Arrastrando: " + elementType);
  }
});



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
      if (ui.draggable.hasClass("lupa-container") && $(this).hasClass("petridish_pre_prac2")){
          $(this).css({"transform": "scale(4)", "transition": "all 0.3s ease"});
      }
    },
    out: function(event, ui) {
      $(this).removeClass('droppable-highlight');
      if (ui.draggable.hasClass("lupa-container") && $(this).hasClass("petridish_pre_prac2")){
           $(this).css({ "transform": "scale(1)", "transition": "all 0.3s ease"});
      }
    },
    drop: function(event, ui) {
      // if(ui.draggable.hasClass("lupa-container")){return false;}
      $(this).removeClass('droppable-highlight');

      let droppedElement = $(ui.helper).clone();
      let elementType = ui.draggable.attr('class').split(' ')[0];
      let dropTarget = $(this);
      let workspace = $('.workspace-inner');

      droppedElement.removeClass('draggable ui-draggable ui-draggable-handle resizable-element')
        .addClass('dropped')
        .addClass(elementType);

      droppedElement.find('.ui-resizable-handle').remove();

      if (droppedElement.hasClass('ui-resizable')) {
        droppedElement.resizable('destroy');
      }

      // Determinar el contenedor de destino
      let appendTarget = determineAppendTarget(elementType, dropTarget.attr('class').split(' ')[0]);
      let targetContainer = appendTarget === 'workspace-inner' ? workspace : dropTarget;

      // Calcular la posición relativa al contenedor de destino
      let containerOffset = targetContainer.offset();
      let dropPositionX = ui.offset.left - containerOffset.left;
      let dropPositionY = ui.offset.top - containerOffset.top;

      droppedElement.css({
        position: 'absolute',
        left: dropPositionX,
        top: dropPositionY,
        zIndex: getHighestZIndex() + 1
      });

      eliminarElementosIguales(droppedElement);

      // Añadir el elemento al contenedor determinado
      targetContainer.append(droppedElement);

      detectSpecificCombination(droppedElement, dropTarget);

      if (!fixedElements.includes(elementType)) {
        droppedElement.draggable({
          containment: appendTarget === 'workspace-inner' ? ".workspace-inner" : "parent",
          start: function(event, ui) {
            $(this).css('zIndex', getHighestZIndex() + 1);
            let elementType = $(this).attr('class').split(' ').find(cls => acceptedElements['workspace-inner'].includes(cls));
            $("#parte1 p").html("Arrastrando (clonado): " + elementType);
          }
        });

        // Agregar evento de doble clic para extraer el elemento
        droppedElement.on('dblclick', function() {
          extractElement($(this));
        });
      }

      if (acceptedElements[elementType]) {
        makeDroppable(droppedElement);
      }
    }
  });
}

// Función para extraer un elemento de su contenedor y añadirlo al workspace-inner
function extractElement(element) {
  let workspace = $('.workspace-inner');
  let currentParent = element.parent();

  // Si el elemento ya está en workspace-inner, no hacemos nada
  if (currentParent.attr('id') === 'workspace-inner') {
    return;
  }

  // Calculamos la posición global del elemento
  let globalPosition = element.offset();

  // Calculamos la nueva posición relativa al workspace-inner
  let workspaceOffset = workspace.offset();
  let newPositionX = globalPosition.left - workspaceOffset.left;
  let newPositionY = globalPosition.top - workspaceOffset.top;

  // Actualizamos la posición y el contenedor del elemento
  element.css({
    left: newPositionX,
    top: newPositionY,
    zIndex: getHighestZIndex() + 1
  });

  // Movemos el elemento al workspace-inner
  workspace.append(element);

  // Actualizamos las propiedades de arrastre
  element.draggable('option', 'containment', '.workspace-inner');
}

// Función para obtener el zIndex más alto
function getHighestZIndex() {
  return Math.max(
    ...Array.from(document.querySelectorAll('body *'))
      .map(el => parseFloat(window.getComputedStyle(el).zIndex))
      .filter(zIndex => !Number.isNaN(zIndex))
  );
}

// Inicializar los elementos droppable
$(".droppable").each(function() {
  makeDroppable($(this));
});

// Función para detectar combinaciones específicas
function detectSpecificCombination(droppedElement, dropTarget) {
  let droppedType = droppedElement.attr('class').split(' ').find(cls => acceptedElements[dropTarget.attr('class').split(' ')[0]].includes(cls));
  let targetType = dropTarget.attr('class').split(' ')[0];

  $("#parte1 p").html(`${droppedType} se soltó sobre ${targetType}`);



  // Acciones específicas basadas en la combinación
  switch(targetType) {
    case 'workspace-inner':
      handleWorkspaceInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'petridish_pre_prac2':
      handlePlacaPetriPreparadaInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'microscopio':
        // cuándo interactuen con el agua
      handleMicroscopioInteraction(droppedType, droppedElement, dropTarget);
      break;
    // Agrega más casos según sea necesario
  }
}

function handleWorkspaceInteraction(elementType, ElementoEnWK, YoWorkspace) {
  switch(elementType) {
    case 'vaso':
      $("#parte1 p").html('Vaso añadido al workspace. Inicializando...');
      ElementoEnWK.find(".agua_vaso").removeClass("hirviendo");
      // Lógica específica para vaso en workspace
      break;
    case 'erlenmeyer':
      $("#parte1 p").html('Erlenmeyer añadido al workspace. Configurando...');
      // Lógica específica para erlenmeyer en workspace
      break;
    case 'plancha-container':
      $("#parte1 p").html('Plancha añadida al workspace. Preparando...');
      // Lógica específica para placa de Petri en workspace
      break;

    case 'petridish_p2':
      $("#parte1 p").html('Placa Petri añadida al workspace. Preparando...');
            // asignar un clase a la placa petri agrega para diferenciarla y que se puedan agregar más , ya que la funcion eliminarElementosIguales elimina elementos iguales tomando como referencia sus clases.


      break;
    // Más casos según sea necesario
  }
}



// CUANDO SE SUELTA EN EL MICROSCOPIO
 function handleMicroscopioInteraction(elementType, soltado_enMicroscopio, YoMicroscopio) {
  if (elementType === 'portaobjetos') {
    $("#parte1 p").html(`${elementType} añadido AL MICROSCOPIO ANALIZANDO...`);


    // Aplicar zoom suave
    $(YoMicroscopio).addClass('zoom-in');

    // Crear pantalla negra con círculo de microscopio
    const microscopeView = $('<div id="microscopeView" class="microscope-view">').appendTo('body');

    const circle = $('<div class="microscope-circle">').appendTo(microscopeView);

    // Generar objetos aleatorios
    const color = Math.random() < 0.5 ? 'purple' : 'pink';
    for (let i = 0; i < 20; i++) {
      $('<div class="microscope-particle">').css({
        left: Math.random() * 100 + '%',
        top: Math.random() * 100 + '%',
        backgroundColor: color,
        animationDelay: Math.random() * 2 + 's'
      }).appendTo(circle);
    }

    // Botón para salir
    $('<button class="microscope-exit-btn">').text('Salir').appendTo(microscopeView).click(() => {
      microscopeView.addClass('fade-out');
      setTimeout(() => {
        microscopeView.remove();
        $(YoMicroscopio).removeClass('zoom-in');
      }, 1000);
    });

    // Activar la animación después de un breve retraso
    setTimeout(() => {
      microscopeView.addClass('active');
    }, 100);
  }
}




function handlePlacaPetriPreparadaInteraction(elementType, soltado_en_PetriPreparada, YoPlacaPetriPreparada) {
    switch(elementType) {
        case 'lupa-container':
        $("#parte1 p").html(`${elementType} añadido AL placa PETRI...->`);
        soltado_en_PetriPreparada.remove();
        break;
}
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
$(".workspace-inner, .vaso, .erlenmeyer, .plancha-container, .phmetro").each(function() {
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

    function initializeWorkspaceDraggables() {
  $(".workspace-inner .dropped").draggable({
    containment: "workspace-inner",
    start: function(event, ui) {
      $(this).css('z-index', getMaxZIndex() + 1);
      let elementType = $(this).attr('class').split(' ').find(cls => acceptedElements['workspace-inner'].includes(cls));
      $("#parte1 p").html("Arrastrando (existente): " + elementType);
    }
  });
}





        function LlenarBotellas(){
            $('.reactivo').each(function() {
                const liquido_botella = $(this).find('.liquido_botella');
                liquido_botella.css('height', '40px');
            });


            $('.medio_cultivo_caldo').each(function() {
                const liquido_botella = $(this).find('.liquido_botella_caldo');
                liquido_botella.css('height', '60%');
            });
        }
        LlenarBotellas();


$(document).on('click', '.dropped', function(event){
    if (event.ctrlKey) {
        // Detener la propagación del evento a otros elementos
        event.stopPropagation();

        // Mostrar alerta de confirmación
        if (confirm('¿Estás seguro(a) de quitar del espacio de trabajo?')) {
            // Destruir el objeto si se acepta
            $(this).remove();
        }
    }
});


});


    </script>
</body>

</html>