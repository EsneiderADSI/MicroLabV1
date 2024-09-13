<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MicroLab</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400&display=swap" rel="stylesheet">
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
                <p>Tubo de Ensayo</p>
                @include('paginas.modulo-1-objetos.tubo-ensayo')
                <div class="divider"></div>
                <p>Frasco</p>
                @include('paginas.modulo-1-objetos.frasco')
                <div class="divider"></div>
                <p>Reactivos</p>
                @include('paginas.modulo-1-objetos.reactivos')
                <div class="divider"></div>
                <p>Medios de Cultivo</p>
                @include('paginas.modulo-1-objetos.medios_de_cultivo')
                <p>Medios de Cultivo Caldos</p>
                @include('paginas.modulo-1-objetos.medios_de_cultivo_caldos')
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
                <blockquote>PARASITOLOGÍA INTESTINAL</blockquote>
<ul id="tabs-swipe-demo" class="tabs">
    <li class="tab col s3"><a class="active" href="#parte1">Paso 1</a></li>
    <li class="tab col s3"><a href="#parte2">Paso 2 !</a></li>
    <li class="tab col s3"><a href="#parte3">Paso 3 !</a></li>
    <li class="tab col s3"><a href="#parte4">Paso 4 !</a></li>
    <li class="tab col s3"><a href="#parte5">Paso 5 !</a></li>
    <li class="tab col s3"><a href="#parte6">Paso 6 !</a></li>
    <li class="tab col s3"><a href="#parte7">Paso 7 !</a></li>
    <li class="tab col s3"><a href="#coo" class="disabled flow-text" id="coordinates"></a></li>
</ul>

<div id="parte1" class="col s12 agrupador">
        <p></p>
         <ol style="padding-left: 20px; font-size: 13px;">
            <li>Pasos </li>
        </ol>


</div>
<div id="parte2" class="col s12 agrupador">
    <p>Contenido del parte 2</p>
         <ol style="padding-left: 20px; font-size: 13px;">
            <li>Pasos </li>
        </ol>
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

{{-- <div class="receptor draggable"></div> --}}
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
  'workspace-inner': ['vaso', 'erlenmeyer', 'petridish', 'reactivo', 'microorganismo', 'mechero-container', 'autoclave-container', 'plancha-container', 'incubadora-container', 'cabina-container', 'phmetro', 'tubo-ensayo-container', 'portaobjetos', 'cubreobjetos'],
  'vaso': ['medio_cultivo', 'reactivo', 'microorganismo', 'phmetro'],
  'plancha-container': ['vaso', 'erlenmeyer'],
  'petridish': ['agar', 'microorganismo'],
  'incubadora-container': ['petridish'],
  'autoclave-container': ['vaso'],
  'petridish': ['vaso'],
  'erlenmeyer': ['medio_cultivo_caldo', 'reactivo', 'phmetro'],
  'tubo-ensayo-container': ['erlenmeyer'],
  'cabina-container': ['erlenmeyer']
};

// Lista de elementos que deben permanecer fijos en su posición inicial cuándo se suelta en el workspace-inner
const fixedElements = ["autoclave-container", "incubadora-container", "mechero-container", "plancha-container", "cabina-container"];

// Función para determinar dónde se debe agregar el elemento
function determineAppendTarget(draggableType, droppableType) {
  // Lista de combinaciones que deben agregarse al contenedor específico
  const appendToTargetCombinations = [
    { draggable: 'medio_cultivo', droppable: 'vaso' },
    { draggable: 'medio_cultivo_caldo', droppable: 'erlenmeyer' },
    { draggable: 'microorganismo', droppable: 'petridish' },
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

  $("#parte1 p").html(`${droppedType} se soltó sobre ${targetType}`);



  // Acciones específicas basadas en la combinación
  switch(targetType) {
    case 'workspace-inner':
      handleWorkspaceInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'vaso':
      handleVasoInteraction(droppedType, droppedElement, dropTarget);
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

    case 'petridish':
      $("#parte1 p").html('Placa Petri añadida al workspace. Preparando...');
            // asignar un clase a la placa petri agrega para diferenciarla y que se puedan agregar más , ya que la funcion eliminarElementosIguales elimina elementos iguales tomando como referencia sus clases.


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
            soltado_en_el_vaso.remove();
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
    case 'microorganismo':
      $("#parte1 p").html('Microorganismo añadido al vaso. Iniciando cultivo...');
      // Lógica para microorganismo en vaso
      soltado_en_el_vaso.remove();
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


function handlePlanchaInteraction(elementType, soltado_en_plancha, YoPlancha) {
  // Implementa la lógica específica para interacciones Plancha
  $("#parte1 p").html(`${elementType} añadido a la PLANCHA`);
    YoPlancha.find(".top-plate").css("background-color", "#ffe082");
  soltado_en_plancha.find(".agua_vaso").addClass("hirviendo");
}

function handleAutoclaveInteraction(elementType, soltado_en_Autoclave, YoAutoclave) {
  // Implementa la lógica específica para interaccion
  $("#parte1 p").html(`${elementType} añadido AL aUTOCLAVE`);
  YoAutoclave.find(".boton_autoclave, .boton_autoclave_2").addClass("animar");
  // Animar la subida de temperatura
  $({ temp: 0 }).animate({ temp: 121 }, {
    duration: 60000,
    step: function(now) {
        YoAutoclave.find(".temperatura_autoclave").text(Math.floor(now) + "°C");
    }
});


}

function handlePlacaPetriInteraction(elementType, soltado_en_PlacaPetri, YoPlacaPetri) {
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL placa PETRI`);

    // Generar un id único para la placa petri (añadir prefijo)
    var id_unico_petridish = 'petridish_' + Math.floor(Math.random() * (10000 - 10 + 1)) + 10;
    // Asignar el id único al elemento YoPlacaPetri
    YoPlacaPetri.attr('id', id_unico_petridish);
    // Cambiar el color del pseudo-elemento ::before para la placa petri específica
    var LiquidoVaso = rgbAHex(soltado_en_PlacaPetri.find('.agua_vaso').css('background-color'));

    // Aplicar el estilo al pseudo-elemento ::before del id generado
    $("<style>#" + id_unico_petridish + "::before { background-color: " + LiquidoVaso + " !important; }</style>").appendTo("head");
}


function handleIncubadoraInteraction(elementType, soltado_en_Incubadora, YoIncubadora) {
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido A la INCUBADORA`);
    soltado_en_Incubadora.animate({
        opacity: 0,      // Cambiar opacidad a 0 para que se desvanezca
        height: "0px",   // Cambiar la altura a 0
        width: "0px"     // Cambiar el ancho a 0
    }, 500, function() {  // Duración de la animación: 500ms
        soltado_en_Incubadora.css("display", "none"); // Después de la animación, ocultamos el elemento
    });

  $({ temp: 0 }).animate({ temp: 45 }, {
    duration: 6000,
    step: function(now) {
        YoIncubadora.find(".screen_incubadora").text(Math.floor(now) + "°C");
        knob_incubadora = YoIncubadora.find('.knob_incubadora');
        if (now ==45){knob_incubadora.css("background-color", "#0f0"); $(".workspace-inner .petridish").css("display", "block").animate({ width: "80px", height: "80px", opacity: 1 }, 500);}else{knob_incubadora.css("background-color", "#d22");}
    }
});


}


 function handleErlenmeyerInteraction(elementType, soltado_en_Erlenmeyer, YoErlenmeyer) {
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL Erlenmeyer`);
  switch(elementType) {
    case 'medio_cultivo_caldo':
      $("#parte1 p").html('Medio de cultivo Caldo añadido al erlenmeyer. Mezclando...');
      // Lógica para medio de cultivo en vaso
        soltado_en_Erlenmeyer.draggable({containment: "parent" });

        const agua_erlenmeyer = YoErlenmeyer.find('.agua_erlenmeyer');

        // Obtener el alto del contenedor del vaso (para calcular el porcentaje)
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

            // Aplicar el color mezclado al vaso
            agua_erlenmeyer.css('background-color', colorMezclado);
            YoErlenmeyer.attr('data', '{"tipo": soltado_en_Erlenmeyer.attr("tipo"), "accion":"mezclado"}')

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
    // Mostrar mensaje de interacción
    $("#parte1 p").html(`${elementType} añadido AL TUBO DE ENSAYO`);

    // Generar un id único para la placa petri (añadir prefijo)
    var id_unico_tubo = 'tubo_ensayo' + Math.floor(Math.random() * (10000 - 10 + 1)) + 10;
    // Asignar el id único al elemento YoTuboEnsayo
    YoTuboEnsayo.attr('id', id_unico_tubo);


    var LiquidoErlenmeyer = rgbAHex(soltado_en_TuboEnsayo.find('.agua_erlenmeyer').css('background-color'));
    YoTuboEnsayo.find('.liquido-tubo').css({ 'background-color': LiquidoErlenmeyer, 'height': '98%' });

}


function handleCabinaInteraction(elementType, soltado_en_Cabina, YoCabina) {
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
        if (confirm('¿Estás seguro(a) de que deseas eliminar este elemento?')) {
            // Destruir el objeto si se acepta
            $(this).remove();
        }
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