<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLab P4</title>
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
                <p>Alimentos</p>
                @include('paginas.objetos.practica4.hongos-filamentosos')
                <div class="divider"></div>
                <p>Muestras clínicas</p>
                @include('paginas.objetos.practica4.muestras-clinicas')
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



        </div>
        <!-- Espacio de trabajo central -->
        <div class="workspace col-md-6">
            <div id="parte1" class="workspace-inner lime lighten-4">
                <blockquote>Hongos filamentosos <a style="font-size: 12px;" href="javascript:void(0)" class="disabled flow-text" id="coordinates"></a></blockquote>

                <p></p>
            </div>
        </div>
        <!-- Sidebar derecha -->
        <div class="sidebar col-sm-3  lime lighten-5">
            <h5>Herramientas</h5>
            <!-- Aquí puedes agregar herramientas adicionales o configuraciones -->
            @include('paginas.objetos.mechero')
            @include('paginas.objetos.microscopio')
            @include('paginas.objetos.pipeta')
            @include('paginas.objetos.autoclave')

        </div>

    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/etiquetas.js') }}"></script>
<script src="{{ asset('assets/js/mi.jsp3.js') }}"></script>
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
  'workspace-inner': ['balanza','vaso', 'erlenmeyer', 'petridish_p3', 'reactivo', 'microorganismo', 'mechero-container', 'autoclave-container', 'plancha-container', 'incubadora-container', 'cabina-container', 'tubo-ensayo-container', 'portaobjetos', 'cubreobjetos', 'microscopio', 'asa1-container', 'asa2-container', 'petridish_pre_prac2','tubo-ensayo-container_micro', 'pipeta', 'lupa-container', 'pann', 'manza', 'zana', 'piel', 'unia', 'caspa'],

  'incubadora-container': ['petridish_p3'],
  'autoclave-container': ['vaso'],
  'erlenmeyer': ['medio_cultivo_caldo', 'reactivo', 'phmetro'],
  'tubo-ensayo-container': ['erlenmeyer'],
  'cabina-container': ['erlenmeyer'],
  'mechero-container': ['asa1-container', 'asa2-container'],
  'petridish_p3': ['asa1-container', 'asa2-container', 'lupa-container'],
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
    { draggable: 'microorganismo', droppable: 'petridish_p3' },
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
      if (ui.draggable.hasClass("lupa-container") && $(this).hasClass("petridish_p3")){
          $(this).css({"transform": "scale(4)", "transition": "all 0.3s ease"});
      }
    },
    out: function(event, ui) {
      $(this).removeClass('droppable-highlight');
      if (ui.draggable.hasClass("lupa-container") && $(this).hasClass("petridish_p3")){
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
    case 'vaso':
      handleVasoInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'balanza':
      handleBalanzaInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'plancha-container':
      handlePlanchaInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'autoclave-container':
      handleAutoclaveInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'petridish_p3':
      handlePlacaPetriInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'incubadora-container':
      handleIncubadoraInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'erlenmeyer':
      handleErlenmeyerInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'tubo-ensayo-container':
      handleTuboEnsayoInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'cabina-container':
      handleCabinaInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'mechero-container':
      handleMecheroInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'petridish_pre':
      handlePlacaPetriPreparadaInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'tubo-ensayo-container_micro':
      handleTuboEnsayoMicroorganismoInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'reactivo':
        // cuándo interactuen con el agua
      handleReactivoInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'portaobjetos':
        // cuándo interactuen con el agua
      handlePortaObjetoInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'microscopio':
        // cuándo interactuen con el agua
      handleMicroscopioInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'nevera':
        // cuándo interactuen con el agua
      handleNeveraInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'muestra':
        // cuándo interactuen con el agua
      handleMuestraInteraction(droppedType, droppedElement, dropTarget);
      break;
  }
}

function handleWorkspaceInteraction(elementType, ElementoEnWK, YoWorkspace) {
  switch(elementType) {
    case 'vaso':
      $("#parte1 p").html('Vaso añadido al workspace. Inicializando...');
      // ElementoEnWK.find(".agua_vaso").removeClass("hirviendo");
      // Lógica específica para vaso en workspace
      break;
    case 'erlenmeyer':
      $("#parte1 p").html('Erlenmeyer añadido al workspace. Configurando...');
        ElementoEnWK.find(".agua_erlenmeyer").removeClass("hirviendo");
      // Lógica específica para erlenmeyer en workspace
      break;
    case 'plancha-container':
      $("#parte1 p").html('Plancha añadida al workspace. Preparando...');
      // Lógica específica para placa de Petri en workspace
      break;

    case 'petridish':
      $("#parte1 p").html('Placa Petri añadida al workspace. Preparando...');
      break;

    case 'asa1-container':
      if (ElementoEnWK.find(".caliente").length > 0){
            ElementoEnWK.find(".asa_1").animate(
              { backgroundColor: "#fff8e1" },
              {
                duration: 3000,
                step: function() {
                  $(this).removeClass('caliente').addClass('caliente_suave');
                },
                complete: function() {
                  $(this).attr("tiene_microorganismo", "no");
                }
              }
            );
      }
      break;

    case 'asa2-container':
      if (ElementoEnWK.find(".caliente").length > 0){
            ElementoEnWK.find(".asa_2").animate(
              { backgroundColor: "#fff8e1" },
              {
                duration: 3000,
                step: function() {
                  $(this).removeClass('caliente').addClass('caliente_suave');
                },
                complete: function() {
                  $(this).attr("tiene_microorganismo", "no");
                }
              }
            );
      }
      break;
    // Más casos según sea necesario
  }
}

function handleVasoInteraction(elementType, soltado_en_el_vaso, Yovaso) {
  switch(elementType) {
    case 'medio_cultivo':
      $("#parte1 p").html('Medio de cultivo añadido al vaso. Mezclando...');
      // Lógica para medio de cultivo en vaso
        soltado_en_el_vaso.draggable({containment: "parent" });

        const agua_vaso = Yovaso.find('.agua_vaso');

        // Obtener el alto del contenedor del vaso (para calcular el porcentaje)
        const alturaContenedor = agua_vaso.parent().height();

        // Obtener la altura actual en píxeles y calcular su porcentaje
        const alturaActual = parseFloat(agua_vaso.css('height'));
        const porcentajeAltura = (alturaActual / alturaContenedor) * 100;

        // Verificar si el porcentaje es menor o igual al 10%
        if (porcentajeAltura <= 10) {
            alert("No hay suficiente agua en el vaso");
            // soltado_en_el_vaso.remove();
        } else {
            // Convertir los colores a formato hexadecimal
            var color_Agua_Hex = rgbAHex(agua_vaso.css('background-color'));
            var color_agar_Hex = soltado_en_el_vaso.attr('color')

            // Mezclar los colores en hexadecimal
            const colorMezclado = mezclarColoresHex(color_Agua_Hex, color_agar_Hex);

            // Aplicar el color mezclado al vaso
            agua_vaso.css('background-color', colorMezclado);
            Yovaso.attr('data', '{"tipo": soltado_en_el_vaso.attr("tipo"), "accion":"mezclado"}')

            // Mostrar el color mezclado en el elemento correspondiente
            $("#parte1 p").html(colorMezclado+ "\n" + "color_Agua_Hex "+ color_Agua_Hex+ " color_agar_Hex "+ color_agar_Hex);
            soltado_en_el_vaso.remove();
        }


      break;
    case 'reactivo':
      $("#parte1 p").html('REACTIVO SOLTADO SOBRE EL VASO...');
      if (soltado_en_el_vaso.hasClass('agua')){
            const agua_vaso = Yovaso.find('.agua_vaso');

            let input = prompt("ESCRIBA EL NIVEL DE AGUA PARA EL VASO EN % (UN NÚMERO DE 1 A 100)");
            // Convierte la entrada a un número entero
            let procentaje_agua = parseInt(input, 10);
            // no pasar de 100
            procentaje_agua = procentaje_agua > 100 ? 100 : (procentaje_agua < 0 ? 0 : procentaje_agua);

            if (!isNaN(procentaje_agua)) {
                agua_vaso.css('height', procentaje_agua+'%');
            } else {
                agua_vaso.css('height','0%');
            }

        soltado_en_el_vaso.remove();
      }

      if (soltado_en_el_vaso.hasClass('hidroxido_de_sodio')){
            if (confirm('¿Estás seguro(a) de aplicar Hidróxido de sodio ?')) {
                soltado_en_el_vaso.remove();
                Yovaso.attr('regulador_ph', "NaOH");
            }
      }

        if (soltado_en_el_vaso.hasClass('acido_clorhidrico')){
            if (confirm('¿Estás seguro(a) de aplicar Ácido clorhídrico?')) {
                soltado_en_el_vaso.remove();
                Yovaso.attr('regulador_ph', "HCl");
            }
      }
      // Lógica para pHmetro en vaso
      break;
    case 'muestra':
      $("#parte1 p").html('muestra añadido al vaso...');
      // Lógica para muestra en vaso
      var valor =  soltado_en_el_vaso.attr("esta_triturada");
      if(valor == "si") {
          Yovaso.attr('tiene_muestra_triturada', 'si');
          soltado_en_el_vaso.remove();
      }else{
        alert("La muestra no está triturada");
      }
      break;

     case 'pipeta':
        // solo si a la pipeta quien le apunta es al agua
        var valor_vaso = Yovaso.attr("tiene_muestra_triturada");
        if (valor_vaso == "si"){
            soltado_en_el_vaso.find('.tip_pipeta').css('background-color', '#3498db');
            soltado_en_el_vaso.addClass("tiene_muestra_triturada");

        }

        break;

    case 'phmetro':
    const valor_ph = () => (Math.random() * (7.4 - 6.8) + 6.8).toFixed(1);
      $("#parte1 p").html('El PHMETRO añadido al vaso. Iniciando medición...');
      if (['HCl', 'NaOH'].includes(Yovaso.attr('regulador_ph'))) {
        soltado_en_el_vaso.find(".pantalla_phmetro").text(valor_ph);
        alert("El valor del PH es el adecuado");


    }else{
        alert("El PH no es el adecuado , utiliza una solución de hidróxido de sodio de o ácido clorhídrico para nivelarlo");
    }
      break;
  } /*CASE*/
} /*FUNCIÓN*/


function handleBalanzaInteraction(elementType, soltado_en_balanza, YoBalanza) {
  // Implementa la lógica específica para interacciones Plancha
  $("#parte1 p").html(`${elementType} añadido a la BALANZA`);
    switch(elementType) {
     case 'medio_cultivo':
        let weight = YoBalanza.find(".display_balanza").attr("value"); // Acceder al atributo value
        soltado_en_balanza.text(weight + "g").attr("value", weight);

        break;
}
}

function handlePlanchaInteraction(elementType, soltado_en_plancha, YoPlancha) {
  // Implementa la lógica específica para interacciones Plancha
    switch(elementType) {
     case 'erlenmeyer':
      $("#parte1 p").html(`${elementType} añadido a la PLANCHA`);
        YoPlancha.find(".top-plate").css("background-color", "#fff8e1");
      // soltado_en_plancha.find(".agua_vaso").addClass("hirviendo");
      soltado_en_plancha.find(".agua_erlenmeyer").addClass("hirviendo");

}
}

function handleAutoclaveInteraction(elementType, soltado_en_Autoclave, YoAutoclave) {

  // Implementa la lógica específica para interaccion
    soltado_en_Autoclave.animate({
        opacity: 0,      // Cambiar opacidad a 0 para que se desvanezca
    }, 500, function() {  // Duración de la animación: 500ms
        soltado_en_Autoclave.css("display", "none"); // Después de la animación, ocultamos el elemento
    });

  $("#parte1 p").html(`${elementType} añadido AL aUTOCLAVE`);
  YoAutoclave.find(".boton_autoclave, .boton_autoclave_2").addClass("animar");
  // Animar la subida de temperatura
  $({ temp: 0 }).animate({ temp: 121 }, {
    duration: 10000,
    step: function(now) {
        YoAutoclave.find(".temperatura_autoclave").text(Math.floor(now) + "°C");

        if (now ==121){
          soltado_en_Autoclave.css("display", "block").animate({ opacity: 1 }, 500);
         }
    }
});


}

function handlePlacaPetriInteraction(elementType, soltado_en_PlacaPetri, YoPlacaPetri) {
    switch(elementType) {
        case 'erlenmeyer':
        // Mostrar mensaje de interacción
        $("#parte1 p").html(`${elementType} añadido AL placa PETRI`);

        // Generar un id único para la placa petri (añadir prefijo)
        var id_unico_petridish = 'petridish_' + Math.floor(Math.random() * (10000 - 10 + 1)) + 10;
        // Asignar el id único al elemento YoPlacaPetri
        YoPlacaPetri.attr('id', id_unico_petridish).addClass("utilizada");
        // Cambiar el color del pseudo-elemento ::before para la placa petri específica
        var LiquidoVaso = rgbAHex(soltado_en_PlacaPetri.find('.agua_erlenmeyer').css('background-color'));

        // Aplicar el estilo al pseudo-elemento ::before del id generado
        $("<style>#" + id_unico_petridish + "::before { background-color: " + LiquidoVaso + " !important; }</style>").appendTo("head");
        break;

        case 'asa1-container':
            $("#parte1 p").html(`${elementType} EL ASA SOLTÓ MICROORGANISMO TOMADO DE LA PLACA PETRI PREPARADA`);

            if(soltado_en_PlacaPetri.find(".asa_1").hasClass("caliente") || soltado_en_PlacaPetri.find(".asa_1").hasClass("caliente_suave")) {
                soltado_en_PlacaPetri.find(".asa_1").removeClass("caliente").addClass("caliente_suave");
                 var objeto_colonia = YoPlacaPetri.find(".heces_p3").first().clone();
                  soltado_en_PlacaPetri.find(".asa_1").find(".heces_p3").remove();
                  soltado_en_PlacaPetri.find(".asa_1").append(objeto_colonia);
                  soltado_en_PlacaPetri.find(".asa_1").addClass("tieneMuestra");

            }else{
              alert("El asa circular no está esterilizada");
            }





        break;

        case 'asa2-container':
          // mezclar el agua con la muestra que deja la pipeta en la placa petri usando el agua 2
          if (YoPlacaPetri.find(".gota_Agua_ConMuestra")){

            if(soltado_en_PlacaPetri.find(".asa_2").hasClass("caliente") || soltado_en_PlacaPetri.find(".asa_2").hasClass("caliente_suave")) {
                soltado_en_PlacaPetri.find(".asa_2").removeClass("caliente").addClass("caliente_suave");

                  YoPlacaPetri.find(".gota_Agua_ConMuestra").animate({
                      backgroundColor: "transparent"
                    }, 5000);
                  YoPlacaPetri.addClass("lista_para_incubar");
            }else{
              alert("El asa digralsky no está esterilizada");
            }

          }


        break;

        case 'pipeta':

            $("#parte1 p").html(`${elementType} LA PIPETA SE SOLTÓ SOBRE LA PLACA PETRI`);

            if (soltado_en_PlacaPetri.hasClass("tiene_muestra_tb_ensayo")) {
            // Generar un id único para la placa petri (añadir prefijo)
            var id_unico_petridish = 'petridish_' + Math.floor(Math.random() * (10000 - 10 + 1)) + 10;
            // Asignar el id único al elemento YoPlacaPetri
            YoPlacaPetri.attr('id', id_unico_petridish).attr("muestra_de_pipeta", "si");
            // Cambiar el color del pseudo-elemento ::before para la placa petri específica
            var LiquidoVaso = rgbAHex(soltado_en_PlacaPetri.find('.tip_pipeta').css('background-color'));

            // Aplicar el estilo al pseudo-elemento ::before del id generado
            $("<style>#" + id_unico_petridish + "::before { background-color: " + LiquidoVaso + " !important; }</style>").appendTo("head");

            }

         if (soltado_en_PlacaPetri.hasClass('tiene_muestra_triturada')) {

            YoPlacaPetri.append('<div class="gota_Agua_ConMuestra"></div>').attr("tiene_gota_Agua_Muestra", "si");

        }

        break;


}

}


function handleIncubadoraInteraction(elementType, soltado_en_Incubadora, YoIncubadora) {
    switch(elementType) {
     case 'petridish':
      if (!soltado_en_Incubadora.hasClass("lista_para_incubar")){alert("No está lista para incubar");return;}
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido A la INCUBADORA`);
    soltado_en_Incubadora.animate({
        opacity: 0,      // Cambiar opacidad a 0 para que se desvanezca
        height: "0px",   // Cambiar la altura a 0
        width: "0px"     // Cambiar el ancho a 0
    }, 500, function() {  // Duración de la animación: 500ms
        soltado_en_Incubadora.css("display", "none"); // Después de la animación, ocultamos el elemento
    });

  $({ temp: 0 }).animate({ temp: 37 }, {
    duration: 6000,
    step: function(now) {
        YoIncubadora.find(".screen_incubadora").text(Math.floor(now) + "°C");
        knob_incubadora = YoIncubadora.find('.knob_incubadora');
        if (now ==37){
          knob_incubadora.css("background-color", "#0f0"); $(".workspace-inner .petridish").css("display", "block").animate({ width: "80px", height: "80px", opacity: 1 }, 500);
            // solo poblar si es una placa utilizada , osea ya tiene una muestra de cultivo preparada
            if (soltado_en_Incubadora.hasClass("utilizada")) {
            soltado_en_Incubadora.find(".microorganism_petridish_pre").remove();
            for (let i = 0; i < 15; i++) { PoblarPlacaPetri(soltado_en_Incubadora); }
            soltado_en_Incubadora.addClass("colonia_crecida");
          }
         }else{
          knob_incubadora.css("background-color", "#d22");
        }

    }
});





break;
}
}

function PoblarPlacaPetri(petriDish) {
    const microorganism = document.createElement('div');
    microorganism.className = 'microorganism_petridish_pre';

    const size = Math.random() * 6 + 2; // Size between 2px and 8px
    const top = Math.random() * 60 + 20; // Position between 20% and 80%
    const left = Math.random() * 60 + 20; // Position between 20% and 80%

    microorganism.style.width = `${size}px`;
    microorganism.style.height = `${size}px`;
    microorganism.style.top = `${top}%`;
    microorganism.style.left = `${left}%`;

    const hue = Math.floor(Math.random() * 360);
    var color = `hsl(${hue}, 70%, 50%)`;
    microorganism.style.backgroundColor = color;

    petriDish.append(microorganism);
}

 function handleErlenmeyerInteraction(elementType, soltado_en_Erlenmeyer, YoErlenmeyer) {
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL Erlenmeyer`);
  switch(elementType) {
    case 'medio_cultivo':
      $("#parte1 p").html('Medio de cultivo añadido al Erlenmeyer. Mezclando...');
      if (YoErlenmeyer.attr("tiene") === "medio_cultivo_caldo"){alert("Prepare esto en otra muestra limpia"); return false;soltado_en_Erlenmeyer.remove();}
      // Lógica para medio de cultivo en Erlenmeyer
        soltado_en_Erlenmeyer.draggable({containment: "parent" });

        const aguaE = YoErlenmeyer.find('.agua_erlenmeyer');

        // Obtener el alto del contenedor del Erlenmeyer (para calcular el porcentaje)
        const alturaContenedorE = aguaE.parent().height();

        // Obtener la altura actual en píxeles y calcular su porcentaje
        const alturaActualE = parseFloat(aguaE.css('height'));
        const porcentajeAlturaE = (alturaActualE / alturaContenedorE) * 100;

        // Verificar si el porcentaje es menor o igual al 10%
        if (porcentajeAlturaE <= 10) {
            alert("No hay suficiente agua en el Erlenmeyer");
            // soltado_en_Erlenmeyer.remove();
        } else {
            // Convertir los colores a formato hexadecimal
            var color_Agua_Hex = rgbAHex(aguaE.css('background-color'));
            var color_agar_Hex = soltado_en_Erlenmeyer.attr('color')

            // Mezclar los colores en hexadecimal
            const colorMezclado = mezclarColoresHex(color_Agua_Hex, color_agar_Hex);

            // Aplicar el color mezclado al Erlenmeyer
            aguaE.css('background-color', colorMezclado);
            YoErlenmeyer.attr('tiene', 'medio_cultivo_agar');

            // Mostrar el color mezclado en el elemento correspondiente
            $("#parte1 p").html(colorMezclado+ "\n" + "color_Agua_Hex "+ color_Agua_Hex+ " color_agar_Hex "+ color_agar_Hex);
            soltado_en_Erlenmeyer.remove();
        }


      break;

    case 'medio_cultivo_caldo':
      if (YoErlenmeyer.attr("tiene") === "medio_cultivo_agar"){alert("Prepare esto en otra muestra limpia"); return false; soltado_en_Erlenmeyer.remove();}
      $("#parte1 p").html('Medio de cultivo Caldo añadido al erlenmeyer. Mezclando...');
      // Lógica para medio de cultivo en Erlenmeyer
        soltado_en_Erlenmeyer.draggable({containment: "parent" });

        const agua_erlenmeyer = YoErlenmeyer.find('.agua_erlenmeyer');

        // Obtener el alto del contenedor del Erlenmeyer (para calcular el porcentaje)
        const alturaContenedor = agua_erlenmeyer.parent().height();

        // Obtener la altura actual en píxeles y calcular su porcentaje
        const alturaActual = parseFloat(agua_erlenmeyer.css('height'));
        const porcentajeAltura = (alturaActual / alturaContenedor) * 100;

        // Verificar si el porcentaje es menor o igual al 10%
        if (porcentajeAltura <= 10) {
            alert("No hay suficiente agua en el Erlenmeyer");
            soltado_en_Erlenmeyer.remove();
        } else {
            // Convertir los colores a formato hexadecimal
            var color_Agua_Hex = rgbAHex(agua_erlenmeyer.css('background-color'));
            var color_agar_Hex = soltado_en_Erlenmeyer.attr('color')

            // Mezclar los colores en hexadecimal
            const colorMezclado = mezclarColoresHex(color_Agua_Hex, color_agar_Hex);

            // Aplicar el color mezclado al Erlenmeyer
            agua_erlenmeyer.css('background-color', colorMezclado);
            YoErlenmeyer.attr('tiene', 'medio_cultivo_caldo');

            // Mostrar el color mezclado en el elemento correspondiente
            $("#parte1 p").html(colorMezclado+ "\n" + "color_Agua_Hex "+ color_Agua_Hex+ " color_agar_Hex "+ color_agar_Hex);
            soltado_en_Erlenmeyer.remove();
        }


      break;
    case 'reactivo':
      $("#parte1 p").html('REACTIVO SOLTADO SOBRE EL Erlenmeyer...');
      if (soltado_en_Erlenmeyer.hasClass('agua')){
            const agua_erlenmeyer = YoErlenmeyer.find('.agua_erlenmeyer');

            let input = prompt("ESCRIBA EL NIVEL DE AGUA PARA EL Erlenmeyer EN % (UN NÚMERO DE 1 A 100)");
            // Convierte la entrada a un número entero
            let procentaje_agua = parseInt(input, 10);
            // no pasar de 100
            procentaje_agua = procentaje_agua > 100 ? 100 : (procentaje_agua < 0 ? 0 : procentaje_agua);

            if (!isNaN(procentaje_agua)) {
                agua_erlenmeyer.css('height', procentaje_agua+'%');
            } else {
                agua_erlenmeyer.css('height','0%');
            }

        soltado_en_Erlenmeyer.remove();
      }

      if (soltado_en_Erlenmeyer.hasClass('hidroxido_de_sodio')){
            if (confirm('¿Estás seguro(a) de aplicar Hidróxido de sodio ?')) {
                soltado_en_Erlenmeyer.remove();
                YoErlenmeyer.attr('regulador_ph', "NaOH");
            }
      }

        if (soltado_en_Erlenmeyer.hasClass('acido_clorhidrico')){
            if (confirm('¿Estás seguro(a) de aplicar Ácido clorhídrico?')) {
                soltado_en_Erlenmeyer.remove();
                YoErlenmeyer.attr('regulador_ph', "HCl");
            }
      }
      // Lógica para pHmetro en vaso
      break;

    case 'phmetro':
    const valor_ph = () => (Math.random() * (7.4 - 6.8) + 6.8).toFixed(1);
      $("#parte1 p").html('El PHMETRO añadido al Erlenmeyer. Iniciando medición...');
      if (['HCl', 'NaOH'].includes(YoErlenmeyer.attr('regulador_ph'))) {
        soltado_en_Erlenmeyer.find(".pantalla_phmetro").text(valor_ph);
        alert("El valor del PH es el adecuado");


    }else{
        alert("El PH no es el adecuado , utiliza una solución de hidróxido de sodio de o ácido clorhídrico para nivelarlo");
    }
      break;
  } /*CASE*/


}


// INTERACCION CON TUBOS DE ENSAYO

function handleTuboEnsayoInteraction(elementType, soltado_en_TuboEnsayo, YoTuboEnsayo) {
    switch(elementType) {
     case 'erlenmeyer':
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL TUBO DE ENSAYO`);

    // Generar un id único para la placa petri (añadir prefijo)
    var id_unico_tubo = 'tubo_ensayo' + Math.floor(Math.random() * (10000 - 10 + 1)) + 10;
    // Asignar el id único al elemento YoTuboEnsayo
    YoTuboEnsayo.attr('id', id_unico_tubo);


    var LiquidoErlenmeyer = rgbAHex(soltado_en_TuboEnsayo.find('.agua_erlenmeyer').css('background-color'));
    YoTuboEnsayo.find('.liquido-tubo').css({ 'background-color': LiquidoErlenmeyer, 'height': '98%' });
    break;
}
}

// INTERACCION CON TUBOS DE ENSAYO CON MICROORGANISMO

function handleTuboEnsayoMicroorganismoInteraction(elementType, soltado_en_TuboEnsayoMicro, YoTuboEnsayoMicro) {
    switch(elementType) {
     case 'pipeta':
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL TUBO DE ENSAYO CON MICROORGANISMOS`);


    soltado_en_TuboEnsayoMicro.find('.tip_pipeta').css('background-color', '#' + Math.floor(Math.random()*16777215).toString(16));
    soltado_en_TuboEnsayoMicro.addClass("tiene_muestra_tb_ensayo").attr("tiene_muestra_tb_ensayo", "si");
    break;
}
}

// INTERACCION CON EL AGUA
function handleReactivoInteraction(elementType, soltado_en_Agua, YoReactivo) {
    switch(elementType) {
     case 'pipeta':
        // solo si a la pipeta quien le apunta es al agua
        if (YoReactivo.hasClass("agua")){
            // Mostrar mensaje de interacción
            $("#parte1 p").html(`${elementType} añadido AL RECIPIENTE CON AGUA`);


            soltado_en_Agua.find('.tip_pipeta').css('background-color', '#3498db');
            soltado_en_Agua.addClass("tiene_gota_de_Agua");

        }

        if (YoReactivo.hasClass("alcohol")){
            // Mostrar mensaje de interacción
            $("#parte1 p").html(`${elementType} añadido AL RECIPIENTE CON ALCOHOL`);


            soltado_en_Agua.find('.tip_pipeta').css('background-color', '#d0d0d0');
            soltado_en_Agua.addClass("esterilizado");

        }

        if (YoReactivo.hasClass("lugol")){
            // Mostrar mensaje de interacción
            $("#parte1 p").html(`${elementType} añadido AL RECIPIENTE CON LUGOL`);


            soltado_en_Agua.find('.tip_pipeta').css('background-color', '#ffeb3b99');
            soltado_en_Agua.addClass("tiene_gota_de_Lugol");

        }
        break;

}
}

// INTERACCION CON EL AGUA
function handlePortaObjetoInteraction(elementType, soltado_enPortaObjeto, YoPortaObjeto) {
    switch(elementType) {
        case 'pipeta':
            if (soltado_enPortaObjeto.hasClass("tiene_gota_de_Agua")) {
                // Mostrar mensaje de interacción
                $("#parte1 p").html(`${elementType} añadido AL PORTAOBJETOS`);
                if (!YoPortaObjeto.find(".gota_Agua").length > 0) {
                    YoPortaObjeto.append('<div class="gota_Agua"></div>').attr("tiene_gota_Agua", "si");
                }
            }

            if (soltado_enPortaObjeto.hasClass("tiene_gota_de_Lugol")) {
                // Mostrar mensaje de interacción
                $("#parte1 p").html(`${elementType} añadido AL PORTAOBJETOS`);
                if (!YoPortaObjeto.find(".gota_Lugol").length > 0) {
                    YoPortaObjeto.append('<div class="gota_Lugol"></div>').attr("tiene_gota_Lugol", "si");
                }
            }
            break; // Break for 'pipeta'

        case 'asa1-container':
            if (!soltado_enPortaObjeto.find(".heces_p3").length > 0) {
                alert("El asa no tiene una muestra fecal para soltar en el portaobjetos");
            } else {
                if (YoPortaObjeto.find(".gota_Lugol").length > 0) {
                    $("#parte1 p").html(`${elementType} añadido AL PORTAOBJETOS`);
                    var microorganismo_Asa = soltado_enPortaObjeto.find(".heces_p3");
                    YoPortaObjeto.find(".gota_Lugol").append(microorganismo_Asa).attr("tiene_muestra", "si");
                    soltado_enPortaObjeto.find(".heces_p3").remove();

                } else {
                    alert("Primero utilice la pipeta y obtenga una gota de lugol desde el recipiente con lugol y aplíquela al portaobjetos");
                }
            }
            break; // Break for 'asa1-container'


            case 'reactivo':
                var reactivos_gramm = ["cristal-violeta", "lugol", "alcohol", "acetona", "safranina"];

            if (reactivos_gramm.includes(soltado_enPortaObjeto.attr("tipo")) || soltado_enPortaObjeto.attr("tipo") == "aceite_de_inmersion") {
                if (!YoPortaObjeto.find(".microorganism_petridish_pre").length > 0  ) {
                    alert("El portaobjetos no tiene muestras para detectar");
                    soltado_enPortaObjeto.remove();
                } else {
                    $("#parte1 p").html(`${elementType} añadido AL PORTAOBJETOS`);
                    var se_solto = soltado_enPortaObjeto.attr("tipo") ;
                    validarYAgregarReactivoPortaobjetos(se_solto, YoPortaObjeto);
                    soltado_enPortaObjeto.remove();

                }
            }else{
                alert("No puedes aplicar este reactivo aquí.");
                soltado_enPortaObjeto.remove();
            }

            break;
    }
}

function validarYAgregarReactivoPortaobjetos(reactivo, objeto) {
    var reactivos_gramm = ["cristal-violeta", "lugol", "alcohol", "acetona", "safranina"];

    // Verificar si el reactivo está en la lista
    if (!reactivos_gramm.includes(reactivo)) {
        alert("Reactivo no válido");
        return false;
    }

    // Obtener el índice del reactivo actual
    var indiceActual = reactivos_gramm.indexOf(reactivo);

    // Verificar si ya se ha agregado este reactivo
    if (objeto.attr('data-' + reactivo)) {
        alert("Este reactivo ya ha sido agregado");
        return false;
    }

    // Verificar si se han agregado todos los reactivos anteriores
    for (var i = 0; i < indiceActual; i++) {
        if (!objeto.attr('data-' + reactivos_gramm[i])) {
            alert("Primero debes agregar " + reactivos_gramm[i]);
            return false;
        }
    }

    // Si todas las validaciones pasan, agregar el reactivo
    objeto.attr('data-' + reactivo, 'true');
    console.log("Reactivo " + reactivo + " agregado correctamente");
    return true;
}

function PortaObjetostieneTodosLosReactivos(objeto, reactivos_gramm) {
    for (var i = 0; i < reactivos_gramm.length; i++) {
        if (!objeto.attr('data-' + reactivos_gramm[i])) {
            return false;
        }
    }
    return true;
}

// CUANDO SE SUELTA EN EL MICROSCOPIO
function handleMicroscopioInteraction(elementType, soltado_enMicroscopio, YoMicroscopio) {
  if (elementType === 'portaobjetos') {
    $("#parte1 p").html(`${elementType} añadido AL MICROSCOPIO ANALIZANDO...`);

    $(YoMicroscopio).addClass('zoom-in');

    const microscopeView = $('<div id="microscopeView" class="microscope-view">').appendTo('body');
    const circle = $('<div class="microscope-circle">').appendTo(microscopeView);

    // Definición de tipos de parásitos y sus características
    const parasiteTypes = {
      entamoebaHistolytica: {
        name: 'Entamoeba histolytica',
        shapes: ['circle'],
        baseSize: { min: 10, max: 15 }, // tamaño en micras
        color: 'rgba(169, 149, 132, 0.8)',
        frequency: 0.2,
        movement: 'amoeboid',
        details: {
          '40X': ['nucleoVisible', 'vacuolas'],
          '100X': ['cromatina', 'cariososma']
        }
      },
      giardiaLamblia: {
        name: 'Giardia lamblia',
        shapes: ['pear'],
        baseSize: { min: 8, max: 12 },
        color: 'rgba(152, 142, 122, 0.85)',
        frequency: 0.15,
        movement: 'flagellar',
        details: {
          '40X': ['flagelos', 'nucleos'],
          '100X': ['discoSuctorio', 'cuerposMedianos']
        }
      },
      ascarisLumbricoides: {
        name: 'Ascaris lumbricoides (huevos)',
        shapes: ['oval'],
        baseSize: { min: 45, max: 75 },
        color: 'rgba(139, 119, 101, 0.9)',
        frequency: 0.1,
        movement: 'none',
        details: {
          '40X': ['cubiertaExterna'],
          '100X': ['capaInterna', 'contenidoGranular']
        }
      }
    };

    // Elementos de fondo (debris fecal)
    const backgroundElements = {
      fibras: {
        shapes: ['fiber'],
        baseSize: { min: 20, max: 100 },
        color: 'rgba(121, 85, 61, 0.3)',
        frequency: 0.4
      },
      bacterias: {
        shapes: ['dot', 'rod'],
        baseSize: { min: 1, max: 3 },
        color: 'rgba(130, 100, 80, 0.25)',
        frequency: 0.8
      },
      cristales: {
        shapes: ['crystal'],
        baseSize: { min: 5, max: 15 },
        color: 'rgba(200, 180, 160, 0.2)',
        frequency: 0.3
      }
    };

    // Función para crear formas específicas
    function createShape(type, size) {
      const element = $('<div>');

      switch(type) {
        case 'circle':
          element.css({
            'border-radius': '50%',
            'width': `${size}px`,
            'height': `${size}px`
          });
          break;
        case 'pear':
          element.css({
            'border-radius': '60% 40% 40% 60% / 60% 60% 40% 40%',
            'width': `${size * 0.8}px`,
            'height': `${size}px`,
            'transform': `rotate(${Math.random() * 360}deg)`
          });
          break;
        case 'oval':
          element.css({
            'border-radius': '50%',
            'width': `${size * 0.7}px`,
            'height': `${size}px`,
            'transform': `rotate(${Math.random() * 360}deg)`
          });
          break;
        case 'fiber':
          element.css({
            'width': `${size * 0.2}px`,
            'height': `${size}px`,
            'transform': `rotate(${Math.random() * 360}deg)`,
            'border-radius': '30%'
          });
          break;
        case 'dot':
          element.css({
            'border-radius': '50%',
            'width': `${size}px`,
            'height': `${size}px`
          });
          break;
        case 'rod':
          element.css({
            'width': `${size * 0.3}px`,
            'height': `${size}px`,
            'transform': `rotate(${Math.random() * 360}deg)`,
            'border-radius': '20%'
          });
          break;
        case 'crystal':
          element.css({
            'width': `${size}px`,
            'height': `${size}px`,
            'transform': `rotate(${Math.random() * 360}deg) skew(${Math.random() * 20}deg)`
          });
          break;
      }

      return element;
    }

    // Función para generar movimiento
    function addMovement(element, type, objective) {
      const speed = objective === '100X' ? '3s' : '5s';
      const distance = objective === '100X' ? '20px' : '10px';

      switch(type) {
        case 'amoeboid':
          element.css({
            'animation': `amoeboidMovement ${speed} infinite`,
            'animation-timing-function': 'ease-in-out',
            'animation-direction': 'alternate'
          });
          break;
        case 'flagellar':
          element.css({
            'animation': `flagellarMovement ${speed} infinite`,
            'animation-timing-function': 'linear'
          });
          break;
      }
    }

    // Función para agregar detalles según el objetivo
    function addDetails(element, parasite, objective) {
      if (parasite.details && parasite.details[objective]) {
        const details = parasite.details[objective];
        details.forEach(detail => {
          const detailElement = $('<div>').addClass(`detail-${detail}`);
          element.append(detailElement);
        });
      }
    }

    // Función principal para generar partículas
    function generateParticles(objective) {
      circle.empty();

      // Factores de escala según el objetivo
      const scales = {
        '4X': 0.25,
        '10X': 0.5,
        '40X': 1,
        '100X': 2.5
      };

      const scale = scales[objective];

      // Generar fondo primero
      Object.entries(backgroundElements).forEach(([_, props]) => {
        const count = Math.floor(200 * props.frequency * (1/scale));
        for (let i = 0; i < count; i++) {
          const size = (Math.random() * (props.baseSize.max - props.baseSize.min) + props.baseSize.min) * scale;
          const shape = props.shapes[Math.floor(Math.random() * props.shapes.length)];

          const element = createShape(shape, size).addClass('microscope-particle background-element').css({
            left: Math.random() * 95 + '%',
            top: Math.random() * 95 + '%',
            backgroundColor: props.color,
            opacity: Math.random() * 0.3 + 0.2,
            position: 'absolute'
          });

          circle.append(element);
        }
      });

      // Luego generar parásitos
      Object.entries(parasiteTypes).forEach(([_, parasite]) => {
        const count = Math.floor(50 * parasite.frequency * (1/scale));
        for (let i = 0; i < count; i++) {
          const size = (Math.random() * (parasite.baseSize.max - parasite.baseSize.min) + parasite.baseSize.min) * scale;
          const shape = parasite.shapes[Math.floor(Math.random() * parasite.shapes.length)];

          const element = createShape(shape, size).addClass('microscope-particle parasite').css({
            left: Math.random() * 90 + 5 + '%',
            top: Math.random() * 90 + 5 + '%',
            backgroundColor: parasite.color,
            opacity: Math.random() * 0.2 + 0.7,
            position: 'absolute',
            zIndex: 2
          });

          if (objective === '40X' || objective === '100X') {
            addDetails(element, parasite, objective);
          }

          if (parasite.movement !== 'none') {
            addMovement(element, parasite.movement, objective);
          }

          circle.append(element);
        }
      });
    }

    // Crear botones para los objetivos
    const objectiveButtons = $('<div class="objective-buttons">').appendTo(microscopeView);
    ['4X', '10X', '40X', '100X'].forEach(objective => {
      $('<button>')
        .text(objective)
        .addClass('objective-button')
        .appendTo(objectiveButtons)
        .click(() => {
          $('.objective-button').removeClass('active');
          $(event.target).addClass('active');
          generateParticles(objective);
        });
    });

    // Generar vista inicial (4X por defecto)
    generateParticles('4X');

    // Botón para salir
    $('<button class="microscope-exit-btn">')
      .text('Salir')
      .appendTo(microscopeView)
      .click(() => {
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

// Estilos CSS necesarios para las animaciones
const style = document.createElement('style');
style.textContent = `
  @keyframes amoeboidMovement {
    0% { transform: scale(1) translate(0, 0); }
    50% { transform: scale(1.1) translate(10px, 5px); }
    100% { transform: scale(1) translate(0, 0); }
  }

  @keyframes flagellarMovement {
    0% { transform: translate(0, 0) rotate(0deg); }
    25% { transform: translate(10px, 10px) rotate(90deg); }
    50% { transform: translate(0, 20px) rotate(180deg); }
    75% { transform: translate(-10px, 10px) rotate(270deg); }
    100% { transform: translate(0, 0) rotate(360deg); }
  }

  .microscope-particle {
    transition: all 0.3s ease;
  }

  .detail-nucleoVisible {
    position: absolute;
    width: 30%;
    height: 30%;
    background: rgba(0,0,0,0.2);
    border-radius: 50%;
    top: 35%;
    left: 35%;
  }

  .detail-vacuolas {
    position: absolute;
    width: 20%;
    height: 20%;
    background: rgba(255,255,255,0.3);
    border-radius: 50%;
    top: 20%;
    left: 20%;
  }

  .detail-flagelos {
    position: absolute;
    width: 2px;
    height: 150%;
    background: rgba(0,0,0,0.1);
    top: -25%;
    left: 50%;
    transform-origin: bottom;
    animation: flagellarWave 1s infinite;
  }

  @keyframes flagellarWave {
    0% { transform: rotate(-20deg); }
    50% { transform: rotate(20deg); }
    100% { transform: rotate(-20deg); }
  }

  .objective-button {
    padding: 8px 16px;
    margin: 0 5px;
    border: 2px solid #ccc;
    border-radius: 4px;
    background: #fff;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .objective-button.active {
    background: #007bff;
    color: white;
    border-color: #0056b3;
  }

  .microscope-circle {
    position: relative;
    overflow: hidden;
  }

  .background-element {
    pointer-events: none;
  }

  .parasite {
    pointer-events: none;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
  }
`;
document.head.appendChild(style);
// CUANDO SE SUELTA EN EL MICROSCOPIO

// INTERACCION DEL MAZO CON LA MUESTRA A PREPARAR
function handleMuestraInteraction(elementType, soltado_enMuestra, YoMuestra) {
    switch(elementType) {
        case 'mazo-mortero':
                $("#parte1 p").html(`${elementType} añadido A LA MUESTRA`);
                  YoMuestra.attr("esta_triturada", "si");
            break;

    }
}

function handleNeveraInteraction(elementType, soltado_enNevera, YoNevera) {
    switch(elementType) {
        case 'petridish':
    soltado_enNevera.animate({
        opacity: 0,      // Cambiar opacidad a 0 para que se desvanezca
    }, 500, function() {  // Duración de la animación: 500ms
        soltado_enNevera.css("display", "none"); // Después de la animación, ocultamos el elemento
    });

  // Animar la subida de temperatura
  $({ temp: 0 }).animate({ temp: 24 }, {
    duration: 24000,
    step: function(now) {
        YoNevera.find(".logo_nevera").text(Math.floor(now) + " H");
        if (now ==24){
          soltado_enNevera.css("display", "block").animate({ opacity: 1 }, 500);
          abrirPuerta(YoNevera.find(".door_nevera-bottom"));
         }
    }
});
            break;
    }
}

function abrirPuerta(PuertaNevera){
      var isOpen = PuertaNevera.hasClass('open');
      if (isOpen) {
          PuertaNevera.removeClass('open').css('transform', 'rotateY(0deg)');
      } else {
          PuertaNevera.addClass('open').css('transform', 'rotateY(-100deg)');
      }
}

function handleCabinaInteraction(elementType, soltado_en_Cabina, YoCabina) {
    switch(elementType) {
     case 'xxxxxxx':
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido A la CABINA`);
    soltado_en_Cabina.animate({
        opacity: 0,      // Cambiar opacidad a 0 para que se desvanezca
        height: "0px",   // Cambiar la altura a 0
        width: "0px"     // Cambiar el ancho a 0
    }, 500, function() {  // Duración de la animación: 500ms
        soltado_en_Cabina.css("display", "none"); // Después de la animación, ocultamos el elemento
    });

  $({ temp: 0 }).animate({ temp: 45 }, {
    duration: 10000,
    step: function(now) {
        YoCabina.find(".screen_cabina").text(Math.floor(now) + "°C");
        panel_de_control_cf = YoCabina.find('.panel_de_control_cf');
        if (now ==45){panel_de_control_cf.css("background-color", "#0f0"); $(".workspace-inner .erlenmeyer").css("display", "block").animate({ width: "70px", height: "100px", opacity: 1 }, 500);}else{panel_de_control_cf.css("background-color", "#d22");}
    }
});


}
}

function handleMecheroInteraction(elementType, soltado_en_Mechero, YoMechero) {
    switch(elementType) {
     case 'asa1-container':
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL MECHERO`);

        soltado_en_Mechero.find(".asa_1").removeClass('caliente_suave');
        soltado_en_Mechero.find(".asa_1").removeClass('caliente_suave');


        soltado_en_Mechero.find(".asa_1").animate(
              { backgroundColor: "#ffcc80" },
              {
                duration: 8000, // 8000 milisegundos = 8 segundos
                step: function() {
                  $(this).addClass('caliente').removeClass('caliente_suave');
                },
                complete: function() {
                  $(this).attr("tiene_microorganismo", "no");
                }
              }
            );

        break;

    case 'asa2-container':
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL MECHERO`);

        soltado_en_Mechero.find(".asa_2").removeClass('caliente_suave');
        soltado_en_Mechero.find(".asa_2").removeClass('caliente_suave');

        soltado_en_Mechero.find(".asa_2").animate(
              { backgroundColor: "#ffcc80" },
              {
                duration: 8000, // 8000 milisegundos = 8 segundos
                step: function() {
                  $(this).addClass('caliente').removeClass('caliente_suave');
                },
                complete: function() {
                  $(this).attr("tiene_microorganismo", "no");
                }
              }
            );
        soltado_en_Mechero.find(".microorganismo_en_asa2").remove();
        break;

    case 'portaobjetos':
    // Mostrar mensaje de interacción
        $("#parte1 p").html(`${elementType} añadido AL MECHERO`);

        if(soltado_en_Mechero.find(".gota_Agua").length > 0 && soltado_en_Mechero.find(".microorganism_petridish_pre").length > 0){
                soltado_en_Mechero.find(".gota_Agua").animate({
                    backgroundColor: "#CD7F32"  // Marrón quemado claro
                }, 20000);

        soltado_en_Mechero.find(".microorganism_petridish_pre").fadeOut(20000);
        }else{
            alert("El portaobjetos no cumple con lo necesario para pasarlo por el mechero.");
        }

        break;
    }
}


function handlePlacaPetriPreparadaInteraction(elementType, soltado_en_PetriPreparada, YoPlacaPetriPreparada) {
    switch(elementType) {
        case 'asa1-container':
        // Mostrar mensaje de interacción
        $("#parte1 p").html(`${elementType} añadido AL placa PETRI MICROORGANISMO...->`);
    if(soltado_en_PetriPreparada.find(".asa_1").hasClass("caliente") || soltado_en_PetriPreparada.find(".asa_1").hasClass("caliente_suave")) {}else{alert("El asa no está esterilizada"); return;}

        // Validar para recoger con el asa de la colonia aislada
        if (soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").length > 0){
         // poner el microorganismo aquí , en una placa petri sin utilizar
          var micro_de_asa = soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").first().clone();
          micro_de_asa.css({
            top: Math.random() * 60 + 20,
            left:Math.random() * 60 + 20
          });
          if(YoPlacaPetriPreparada.append(micro_de_asa)){
            YoPlacaPetriPreparada.addClass("coloniaAislada");
            soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").remove();
          }


        }
        else
        {

          var objeto_colonia_aislada = YoPlacaPetriPreparada.find(".microorganism_petridish_pre").first().clone();
          objeto_colonia_aislada.css({
              top: Math.random() * 100 + '%',
              left: Math.random() * 100 + '%'
          });
          if(soltado_en_PetriPreparada.find(".asa_1").append(objeto_colonia_aislada)){
            soltado_en_PetriPreparada.find(".asa_1").addClass("TieneMuestraAislada");
          }
        }



        break;

     case 'asa2-container':
        // Mostrar mensaje de interacción
        $("#parte1 p").html(`${elementType} añadido AL placa PETRI MICROORGANISMO...->`);


        if (soltado_en_PetriPreparada.find(".asa_2").attr("tiene_microorganismo") == "si" && soltado_en_PetriPreparada.find(".asa_2").hasClass("caliente_suave")) {
                alert("Lleva el asa con la muestra a tu placa petri");
                return;

             }
             else{
                   if (!soltado_en_PetriPreparada.find(".asa_2").hasClass("caliente")) {
                        alert("El Asa no está caliente , útilice el mechero primero.") ;
                        return;
                    }
                    else{
                    soltado_en_PetriPreparada.find(".asa_2").removeClass('caliente').addClass('caliente_suave');
                    soltado_en_PetriPreparada.find(".asa_2").append('<div class="microorganismo_en_asa2"></div>').attr("tiene_microorganismo", "si");

                    }
             }




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
        $(document).on('click', '.vaso--', function(event){
            if ($(this).hasClass('jhancarlos_agregado')) {
                // Aquí puedes agregar el código que deseas ejecutar si tiene la clase
                alert('El vaso tiene la clase jhancarlos_agregado');
                const medio_cultivo = $(this).find('.medio_cultivo');
                medio_cultivo.css('height', '100px');
                medio_cultivo.css('width', '100px');
                medio_cultivo.css('background-color', '#9b59b6');
            }

            const agua = $(this).find('.agua_vaso');
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
        // Detener la propagación del evento a otros elementos
        event.stopPropagation();

        // Mostrar alerta de confirmación
        if (confirm('¿Estás seguro(a) de quitar del espacio de trabajo?')) {
            // Destruir el objeto si se acepta
            $(this).fadeOut(500, function() { $(this).remove(); });
        }
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