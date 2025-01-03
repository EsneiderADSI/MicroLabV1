<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLab P1</title>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/mi.css') }}">
</head>

<body style="cursor: auto;">
<button id="exitButton" style="display:none;">Salir del Microscopio</button>
<div id="microscopeOverlay" style="display:none;"></div>
    <div class="container-fluid">

        <div class="sidebar col-sm-3 orange lighten-5">
            <h5>Materiales</h5>
            <div class="divider"></div>
                <p>Erlenmeyer</p>
                @include('paginas.objetos.erlenmeyer')
                <div class="divider"></div>
                <p>Tubo de Ensayo</p>
                @include('paginas.objetos.tubo-ensayo')
                <div class="divider"></div>
                @include('paginas.objetos.tubo-ensayo-microorganismo')
                <div class="divider"></div>
                <p>Beaker</p>
                @include('paginas.objetos.frasco')
                <div class="divider"></div>
                <p><a href="{{ asset('Fichas Tecnicas Medios de Cultivo.pdf') }}" target="_blank">Reactivos</a></p>
                @include('paginas.objetos.reactivos')
                <div class="divider"></div>
                <p>Muestras</p>
                @include('paginas.objetos.muestras')
                <div class="divider"></div>
                <p>Medios de Cultivo</p>
                @include('paginas.objetos.medios_de_cultivo')
                <p>Medios de Cultivo Caldos</p>
                @include('paginas.objetos.medios_de_cultivo_caldos')
                <div class="divider"></div>
                <p>Asas Bacteriolóogicas</p>
                @include('paginas.objetos.asa')
                <p></p>
                @include('paginas.objetos.asa2')
                <p></p>
                @include('paginas.objetos.asa3')
                <p></p>
                <div class="divider"></div>
                <p>Espátula</p>
                @include('paginas.objetos.espatula')
                <p></p>
                <div class="divider"></div>
                <p>Placa Petri</p>
                <div class="divider"></div>
                @include('paginas.objetos.placa-petri')

                @include('paginas.objetos.placa-petri-preparada')
                <p></p>
                <div class="divider"></div>
                <p>Porta/Cubre Objetos</p>
                @include('paginas.objetos.portaobjetos')
                @include('paginas.objetos.cubreobjetos')

        </div>
        <!-- Espacio de trabajo central -->
        <div class="workspace col-md-6">
            <div id="parte1" class="workspace-inner lime lighten-4">
                <blockquote>TÉCNICAS BÁSICAS DE LABORATORIO PARA EL ESTUDIO DE LOS MICROORGANISMOS <a style="font-size: 12px;" href="javascript:void(0)" class="disabled flow-text" id="coordinates"></a></blockquote>
                <div align="right"><a href="/"><i class="material-icons">home</i></a><a href="/modulos"><i class="material-icons">apps</i></a></div>
                <p></p>
            </div>
        </div>
        <!-- Sidebar derecha -->
        <div class="sidebar col-sm-3 orange lighten-5">
            <h5>Herramientas</h5>
            <!-- Aquí puedes agregar herramientas adicionales o configuraciones -->
            @include('paginas.objetos.balanza')
            @include('paginas.objetos.microscopio')
            @include('paginas.objetos.phmetro')
            @include('paginas.objetos.grifo')
            @include('paginas.objetos.pipeta')
            @include('paginas.objetos.gotero')
            @include('paginas.objetos.mechero')
            @include('paginas.objetos.mortero')
            @include('paginas.objetos.mortero-mazo')
            @include('paginas.objetos.plancha-calentamiento')
            @include('paginas.objetos.autoclave')
            @include('paginas.objetos.cabina-de-flujo')
            @include('paginas.objetos.incubadora')
            @include('paginas.objetos.nevera')

        </div>

    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/etiquetas.js') }}"></script>
<script src="{{ asset('assets/js/mi.js') }}"></script>
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


// Configuración de elementos aceptados por cada contenedor
const acceptedElements = {
  'workspace-inner': ['balanza','vaso', 'medio_cultivo', 'medio_cultivo_caldo', 'erlenmeyer', 'petridish', 'reactivo', 'microorganismo', 'mechero-container', 'autoclave-container', 'plancha-container', 'incubadora-container', 'cabina-container', 'phmetro', 'tubo-ensayo-container', 'portaobjetos', 'cubreobjetos', 'microscopio', 'asa1-container', 'asa2-container', 'asa3_recta-container', 'petridish_pre','tubo-ensayo-container_micro', 'pipeta', 'gotero', 'espatula', 'nevera', 'mortero-container', 'mazo-mortero', 'sink'],

  'vaso': ['medio_cultivo', 'reactivo', 'muestra', 'phmetro', 'pipeta'],
  'mortero-container': ['muestra'],
  'muestra': ['mazo-mortero'],
  'balanza': ['medio_cultivo'],
  'plancha-container': ['vaso', 'erlenmeyer'],
  'petridish': ['agar', 'microorganismo', 'vaso', 'asa1-container', 'asa2-container', 'pipeta', 'asa2-container', 'erlenmeyer'],
  'incubadora-container': ['petridish', 'petridish_pre'],
  'autoclave-container': ['vaso', 'erlenmeyer', 'asa1-container', 'asa2-container', 'medio_cultivo', 'petridish', 'pipeta'],
  'erlenmeyer': ['medio_cultivo', 'medio_cultivo_caldo', 'reactivo', 'phmetro'],
  'tubo-ensayo-container': ['erlenmeyer'],
  // 'cabina-container': ['erlenmeyer'],
  'mechero-container': ['asa1-container', 'asa2-container', "portaobjetos"],
  'petridish_pre': ['asa1-container', 'asa2-container'],
  'tubo-ensayo-container_micro': ['pipeta'],
  'reactivo': ['pipeta', 'asa2-container'],
  'portaobjetos': ['pipeta', 'asa1-container', 'reactivo', 'cubreobjetos'],
  'sink': ['portaobjetos'],
  'nevera': ['petridish_pre', 'petridish'],
  'microscopio': ['portaobjetos'],
};

// Lista de elementos que deben permanecer fijos en su posición inicial cuándo se suelta en el workspace-inner
const fixedElements = ["autoclave-container", "incubadora-container", "cabina-container", "balanza"];

// Función para determinar dónde se debe agregar el elemento
function determineAppendTarget(draggableType, droppableType) {
  // Lista de combinaciones que deben agregarse al contenedor específico
  const appendToTargetCombinations = [
    { draggable: 'medio_cultivo', droppable: 'vaso' },
    { draggable: 'medio_cultivo_caldo', droppable: 'erlenmeyer' },
    { draggable: 'microorganismo', droppable: 'petridish' },
    { draggable: 'cubreobjetos', droppable: 'portaobjetos' }
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
    let Nombre = $(this).attr('description');
    $("#parte1 p").html("Arrastrando: " + Nombre);
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
    },
    out: function(event, ui) {
      $(this).removeClass('droppable-highlight');
    },
    drop: function(event, ui) {
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

  $("#parte1 p").html(`${droppedElement.attr('description')} se soltó sobre ${targetType}`);



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
    case 'petridish':
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
    case 'medio_cultivox':
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
      if (soltado_en_el_vaso.hasClass('agua')) {
          const agua_vaso = Yovaso.find('.agua_vaso');

          let input = prompt("ESCRIBA EL NIVEL DE AGUA PARA EL VASO EN MILILITROS (UN NÚMERO ENTRE 0 Y 1000)");
          // Convierte la entrada a un número entero
          let mililitros_agua = parseInt(input, 10);

          // Validar y ajustar el valor a un rango de 0 a 1000 ml
          mililitros_agua = mililitros_agua > 1000 ? 1000 : (mililitros_agua < 0 ? 0 : mililitros_agua);

          // Convertir a porcentaje (eliminar último dígito o dividir por 10)
          let porcentaje_agua = Math.floor(mililitros_agua / 10); // Convirtiendo ml a %

          if (!isNaN(porcentaje_agua)) {
              agua_vaso.css('height', porcentaje_agua + '%');
          } else {
              agua_vaso.css('height', '0%');
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
        if(soltado_en_el_vaso.hasClass(".tiene_gota_de_Agua")){
          alert("La pipeta no está esterilizada, introdúcela en alcohol.");
          return;
        }
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
        $("#parte1 p").html(`${elementType} añadido a la placa petri`);
        if(soltado_en_PlacaPetri.attr("tiene") != "medio_cultivo_agar"){alert("Prepare el medio de cultivo primero"); return;}
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
          if (YoPlacaPetri.hasClass("utilizada")){

            if (YoPlacaPetri.hasClass("colonia_crecida")){


            if(soltado_en_PlacaPetri.find(".asa_1").hasClass("caliente") || soltado_en_PlacaPetri.find(".asa_1").hasClass("caliente_suave")) {
                soltado_en_PlacaPetri.find(".asa_1").removeClass("caliente").addClass("caliente_suave");
                 var objeto_colonia = YoPlacaPetri.find(".microorganism_petridish_pre").first().clone();
                // Encuentra todos los elementos con la clase .microorganism_petridish_pre
                var elementos = YoPlacaPetri.find(".microorganism_petridish_pre");
                // Selecciona un índice al azar dentro del rango de elementos encontrados
                var indiceAzar = Math.floor(Math.random() * elementos.length);
                // Clona el elemento seleccionado al azar
                 var objeto_colonia = elementos.eq(indiceAzar).clone();

                  soltado_en_PlacaPetri.find(".asa_1").find(".microorganism_petridish_pre").remove();
                  soltado_en_PlacaPetri.find(".asa_1").append(objeto_colonia);
                  soltado_en_PlacaPetri.find(".asa_1").addClass("tieneMuestra");

            }else{
              alert("El asa circular no está esterilizada");
            }

          }else{alert("Esta placa petri no tiene una colonia para obtener.");}
        }else{

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

  case 'petridish_pre':
      if (!soltado_en_Incubadora.hasClass("coloniaAislada")){alert("No está lista para incubar");return;}
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
          knob_incubadora.css("background-color", "#0f0"); $(".workspace-inner .petridish_pre").css("display", "block").animate({ width: "80px", height: "80px", opacity: 1 }, 500);
            // solo poblar si es una placa utilizada , osea ya tiene una muestra de cultivo preparada
            if (soltado_en_Incubadora.hasClass("coloniaAislada")) {
            for (let i = 0; i < 15; i++) { PoblarPlacaPetriColoniaUnica(soltado_en_Incubadora); }
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

function PoblarPlacaPetriColoniaUnica(petriDish) {
    // Asegúrate de que petriDish sea un objeto jQuery
    const $petriDish = $(petriDish);
    const streamingImage = $petriDish.find('.streaking-image').first();

    if (streamingImage.length > 0) {
        streamingImage.css("display", "none");
    }

    // Crear el nuevo microorganismo
    const microorganism = document.createElement('div');
    microorganism.className = 'microorganism_petridish_pre';

    // Generar tamaño aleatorio entre 2px y 8px
    const size = Math.random() * 6 + 2;

    // Generar posición aleatoria entre 20% y 80%
    const top = Math.random() * 60 + 20;
    const left = Math.random() * 60 + 20;

    // Aplicar tamaño y posición
    microorganism.style.width = `${size}px`;
    microorganism.style.height = `${size}px`;
    microorganism.style.position = 'absolute'; // Asegúrate de que esto esté presente
    microorganism.style.top = `${top}%`;
    microorganism.style.left = `${left}%`;

    // Obtener el color del primer microorganismo existente
    const $existingMicroorganism = $petriDish.find(".microorganism_petridish_pre").first();

    if ($existingMicroorganism.length > 0) {
        // Obtener el color del microorganismo existente
        const color = $existingMicroorganism.css('background-color');
        microorganism.style.backgroundColor = color;
    } else {
        // Si no hay ninguno, establecer un color por defecto
        microorganism.style.backgroundColor = 'red';
    }

    // Agregar el nuevo microorganismo al plato Petri
    $petriDish.append(microorganism);

    // Depuración
    // console.log("Nuevo microorganismo creado:", microorganism);
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
      if (soltado_en_Erlenmeyer.hasClass('agua')) {
          const agua_erlenmeyer = YoErlenmeyer.find('.agua_erlenmeyer');

          let input = prompt("ESCRIBA EL NIVEL DE AGUA PARA EL Erlenmeyer EN MILILITROS (UN NÚMERO ENTRE 0 Y 1000)");
          // Convierte la entrada a un número entero
          let mililitros_agua = parseInt(input, 10);

          // Validar y ajustar el valor a un rango de 0 a 1000 ml
          mililitros_agua = mililitros_agua > 1000 ? 1000 : (mililitros_agua < 0 ? 0 : mililitros_agua);

          // Convertir a porcentaje (eliminar último dígito o dividir por 10)
          let porcentaje_agua = Math.floor(mililitros_agua / 10); // Convirtiendo ml a %

          if (!isNaN(porcentaje_agua)) {
              agua_erlenmeyer.css('height', porcentaje_agua + '%');
          } else {
              agua_erlenmeyer.css('height', '0%');
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
            if (soltado_en_Agua.hasClass("tiene_muestra_triturada")){
              alert("La pipeta no está esterilizada, introdúcela en alcohol.");
              return;
            }
            $("#parte1 p").html(`${elementType} añadido AL RECIPIENTE CON AGUA`);


            soltado_en_Agua.find('.tip_pipeta').css('background-color', '#3498db');
            soltado_en_Agua.addClass("tiene_gota_de_Agua");

        }

        if (YoReactivo.hasClass("alcohol")){
            // Mostrar mensaje de interacción
            $("#parte1 p").html(`${elementType} añadido AL RECIPIENTE CON ALCOHOL`);


            soltado_en_Agua.find('.tip_pipeta').css('background-color', '#d0d0d0');
            soltado_en_Agua.removeClass("tiene_muestra_triturada");
            soltado_en_Agua.addClass("esterilizado");

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
            break; // Break for 'pipeta'

        case 'asa1-container':
            if (!soltado_enPortaObjeto.find(".microorganism_petridish_pre").length > 0) {
                alert("El asa no tiene una muestra de microorganismo para soltar en el portaobjetos");
            } else {
                if (YoPortaObjeto.find(".gota_Agua").length > 0) {
                    $("#parte1 p").html(`${elementType} añadido AL PORTAOBJETOS`);
                    var microorganismo_Asa = soltado_enPortaObjeto.find(".microorganism_petridish_pre");
                    YoPortaObjeto.find(".gota_Agua").append(microorganismo_Asa).attr("tiene_microorganismo", "si");
                    soltado_enPortaObjeto.find(".microorganism_petridish_pre").remove();

                } else {
                    alert("Primero utilice la pipeta y obtenga una gota de agua desde el recipiente de agua y aplíquela al portaobjetos");
                }
            }
            break; // Break for 'asa1-container'


            case 'reactivo':
                var reactivos_gramm = ["cristal-violeta", "lugol", "alcohol", "safranina"];

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
    var reactivos_gramm = ["cristal-violeta", "lugol", "alcohol", "safranina"];

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
    var reactivos_gramm = ["cristal-violeta", "lugol", "alcohol", "safranina"];
    if (!PortaObjetostieneTodosLosReactivos(soltado_enMicroscopio, reactivos_gramm)) {
        alert("El PortaObjeto no tiene la coloración de Gram completa.");
        return false;
    }
    // Aplicar zoom suave
    $(YoMicroscopio).addClass('zoom-in');
    // Crear pantalla negra con círculo de microscopio
    const microscopeView = $('<div id="microscopeView" class="microscope-view">').appendTo('body');
    const circle = $('<div class="microscope-circle">').appendTo(microscopeView);

    // Variables para mantener el tipo y color de bacteria constantes
    let bacteriaType, color;

    // Función para generar partículas según el objetivo
    function generateParticles(objective) {
      // Si es la primera vez, genera tipo y color aleatorios
      if (!bacteriaType) {
        bacteriaType = Math.random() < 0.5 ? 'bacilo' : 'coco';
        color = Math.random() < 0.5 ? 'purple' : 'pink';
      }

      circle.empty(); // Limpiar partículas existentes
      let particleCount, particleWidth, particleHeight, particleOpacity;
      switch(objective) {
        case '4X':
          particleCount = 100;
          particleWidth = 2;
          particleHeight = 6;
          particleOpacity = 0.3;
          break;
        case '10X':
          particleCount = 50;
          particleWidth = 4;
          particleHeight = 12;
          particleOpacity = 0.5;
          break;
        case '40X':
          particleCount = 20;
          particleWidth = 8;
          particleHeight = 24;
          particleOpacity = 0.7;
          break;
        case '100X':
          particleCount = 5;
          particleWidth = 15;
          particleHeight = 45;
          particleOpacity = 1;
          break;
      }

      for (let i = 0; i < particleCount; i++) {
        // Crear partícula de bacteria
        const bacteriaParticle = $('<div class="microscope-particle">');

        if (bacteriaType === 'bacilo') {
          // Estilo para bacilos (rectangulares con bordes redondeados)
          bacteriaParticle.css({
            left: Math.random() * 100 + '%',
            top: Math.random() * 100 + '%',
            backgroundColor: color,
            width: `${particleWidth}px`,
            height: `${particleHeight}px`,
            opacity: particleOpacity,
            animationDelay: Math.random() * 2 + 's',
            borderRadius: '5px' // Bordes redondeados suaves
          });
        } else {
          // Estilo para cocos (circulares)
          bacteriaParticle.css({
            left: Math.random() * 100 + '%',
            top: Math.random() * 100 + '%',
            backgroundColor: color,
            width: `${particleHeight}px`, // Hacer cuadrado para cocos
            height: `${particleHeight}px`,
            opacity: particleOpacity,
            animationDelay: Math.random() * 2 + 's',
            borderRadius: '50%' // Circular
          });
        }

        bacteriaParticle.appendTo(circle);
      }
    }

    // Resto del código permanece igual que en la versión anterior
    const objectiveButtons = $('<div class="objective-buttons">').appendTo(microscopeView);
    ['4X', '10X', '40X', '100X'].forEach(objective => {
      $('<button>').text(objective).appendTo(objectiveButtons).click(() => {
        generateParticles(objective);
      });
    });

    // Generar vista inicial (4X por defecto)
    generateParticles('4X');

    // Botón para salir
    $('<button class="microscope-exit-btn">').text('Salir').appendTo(microscopeView).click(() => {
      microscopeView.addClass('fade-out');
      setTimeout(() => {
        microscopeView.remove();
        $(YoMicroscopio).removeClass('zoom-in');
        // Reiniciar variables para la próxima visualización
        bacteriaType = null;
        color = null;
      }, 1000);
    });

    // Activar la animación después de un breve retraso
    setTimeout(() => {
      microscopeView.addClass('active');
    }, 100);
  }
}
// INTERACCION DEL MAZO CON LA MUESTRA A PREPARAR
function handleMuestraInteraction(elementType, soltado_enMuestra, YoMuestra) {
    switch(elementType) {
        case 'mazo-mortero':
                $("#parte1 p").html(`${elementType} añadido A LA MUESTRA`);
                  YoMuestra.attr("esta_triturada", "si");
                  alert("Lleve está muestra a un Beaker");
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
    $("#parte1 p").html(`${elementType} añadido al Mechero`);

        soltado_en_Mechero.find(".asa_1").removeClass('caliente_suave');
        soltado_en_Mechero.find(".asa_1").removeClass('caliente_suave');
        soltado_en_Mechero.find(".microorganism_petridish_pre").remove();

        soltado_en_Mechero.find(".asa_1").animate(
              { backgroundColor: "#ffcc80" },
              {
                duration: 8000, // 8000 milisegundos = 8 segundos
                step: function() {
                  $(this).addClass('caliente').removeClass('caliente_suave');
                  soltado_en_Mechero.find(".microorganism_petridish_pre").remove();
                },
                complete: function() {
                  $(this).attr("tiene_microorganismo", "no");
                  soltado_en_Mechero.find(".microorganism_petridish_pre").remove();
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
        $("#parte1 p").html(`${elementType} añadido a la placa petri preparada`);
        var streamingImage = YoPlacaPetriPreparada.find('.streaking-image').first();

    if(soltado_en_PetriPreparada.find(".asa_1").hasClass("caliente") || soltado_en_PetriPreparada.find(".asa_1").hasClass("caliente_suave")) {}else{alert("El asa no está esterilizada"); streamingImage.css("display", "none"); return;}

        // Validar para recoger con el asa de la colonia aislada
      if (soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").length > 0) {
          // Clonar el microorganismo del asa
          var micro_de_asa = soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").first().clone();

          // Posicionar aleatoriamente
          micro_de_asa.css({
              top: Math.random() * 60 + 20,
              left: Math.random() * 60 + 20
          });

          // Verificar si YoPlacaPetriPreparada ya tiene algún microorganismo
          var microorganismos_existentes = YoPlacaPetriPreparada.find(".microorganism_petridish_pre");

          if (microorganismos_existentes.length === 0) {
              // Si no hay microorganismos, agregar directamente
              YoPlacaPetriPreparada.append(micro_de_asa);
              YoPlacaPetriPreparada.addClass("coloniaAislada");
              // soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").remove();
              SimularSiembraXEstria(streamingImage, YoPlacaPetriPreparada);
          } else {
              // Verificar el color del primer microorganismo existente
              var color_primer_microorganismo = microorganismos_existentes.first().css('background-color');
              var color_nuevo_microorganismo = micro_de_asa.css('background-color');

              if (color_primer_microorganismo === color_nuevo_microorganismo) {
                  // Si el color es el mismo, agregar normalmente
                  YoPlacaPetriPreparada.append(micro_de_asa);
                  YoPlacaPetriPreparada.addClass("coloniaAislada");
                  // soltado_en_PetriPreparada.find(".asa_1").find(".microorganism_petridish_pre").remove();
                  SimularSiembraXEstria(streamingImage, YoPlacaPetriPreparada);
              } else {
                  // Si el color es diferente, mostrar una alerta
                  alert("ERROR: Estás intentando agregar un microorganismo de una colonia diferente.");
              }
          }
      }
        else
        {

          var objeto_colonia_aislada = YoPlacaPetriPreparada.find(".microorganism_petridish_pre").first().clone();
          objeto_colonia_aislada.css({
              top: Math.random() * 80 + '%',
              left: Math.random() * 80 + '%'
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



        function SimularSiembraXEstria(streamingImage, petriDish) {
          streamingImage.css("display", "block");

        // Obtener las dimensiones de la placa de Petri
        const petriWidth = petriDish.offsetWidth;
        const petriHeight = petriDish.offsetHeight;

        // Obtener las dimensiones de la imagen de siembra
        const imageWidth = streamingImage.offsetWidth;
        const imageHeight = streamingImage.offsetHeight;

        // Calcular la posición centrada de la imagen
        const left = (petriWidth - imageWidth) / 2;
        const top = (petriHeight - imageHeight) / 2;


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