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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
                @include('paginas.objetos.practica4.placa-petri-p4')
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
                <p>Cinta</p>
                @include('paginas.objetos.practica4.cinta')
                <p></p>
                <div class="divider"></div>
                <p>Porta/Cubre Objetos</p>
                @include('paginas.objetos.portaobjetos')



        </div>
        <!-- Espacio de trabajo central -->
        <div class="workspace col-md-6">
            <div id="parte1" class="workspace-inner lime lighten-4">
                <blockquote>Hongos filamentosos <a style="font-size: 12px;" href="javascript:void(0)" class="disabled flow-text" id="coordinates"></a></blockquote>
                <div align="right"><a href="/"><i class="material-icons">home</i></a><a href="/modulos"><i class="material-icons">apps</i></a></div>
                <p></p>
            </div>
        </div>
        <!-- Sidebar derecha -->
        <div class="sidebar col-sm-3  lime lighten-5">
            <h5>Herramientas</h5>
            <!-- Aquí puedes agregar herramientas adicionales o configuraciones -->
            @include('paginas.objetos.mechero')
            @include('paginas.objetos.microscopio')
            @include('paginas.objetos.gotero')
            @include('paginas.objetos.autoclave')
            @include('paginas.objetos.cabina-de-flujo')

        </div>

    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/etiquetas.js') }}"></script>
<script src="{{ asset('assets/js/mi.jsp4.js') }}"></script>
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
  'workspace-inner': ['gotero','vaso', 'cinta', 'petridish_p4', 'reactivo', 'microorganismo', 'mechero-container', 'autoclave-container', 'plancha-container', 'incubadora-container', 'cabina-container', 'tubo-ensayo-container', 'portaobjetos', 'cubreobjetos', 'microscopio', 'asa1-container', 'asa2-container', 'petridish_pre_prac2','tubo-ensayo-container_micro', 'pipeta', 'lupa-container', 'pann', 'tomatte', 'fressa', 'piel', 'unia', 'caspa'],

  'autoclave-container': ['vaso'],
  'cabina-container': ['erlenmeyer'],
  'petridish_p4': ['asa1-container', 'asa2-container', 'lupa-container'],
  'tubo-ensayo-container_micro': ['pipeta'],
  'reactivo': ['gotero'],
  'portaobjetos': ['gotero', 'cinta', 'caspa'],
  'microscopio': ['portaobjetos'],
  'pann': ['cinta'],
  'tomatte': ['cinta'],
  'fressa': ['cinta'],
};

// Lista de elementos que deben permanecer fijos en su posición inicial cuándo se suelta en el workspace-inner
const fixedElements = ["autoclave-container", "incubadora-container", "mechero-container", "plancha-container", "cabina-container", "balanza"];

// Función para determinar dónde se debe agregar el elemento
function determineAppendTarget(draggableType, droppableType) {
  // Lista de combinaciones que deben agregarse al contenedor específico
  const appendToTargetCombinations = [
    // { draggable: 'cinta', droppable: 'portaobjetos' },
    { draggable: 'medio_cultivo_caldo', droppable: 'erlenmeyer' },
    { draggable: 'microorganismo', droppable: 'petridish_p4' },
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
      if (ui.draggable.hasClass("lupa-container") && $(this).hasClass("petridish_p4")){
          $(this).css({"transform": "scale(4)", "transition": "all 0.3s ease"});
      }
    },
    out: function(event, ui) {
      $(this).removeClass('droppable-highlight');
      if (ui.draggable.hasClass("lupa-container") && $(this).hasClass("petridish_p4")){
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

  $("#parte1 p").html(`${droppedElement.attr('description')} se soltó sobre ${targetType}`);



    // Acciones específicas basadas en la combinación
  switch(targetType) {
    case 'workspace-inner':
      handleWorkspaceInteraction(droppedType, droppedElement, dropTarget);
      break;
    case 'petridish_p4':
      handlePlacaPetriInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'cabina-container':
      handleCabinaInteraction(droppedType, droppedElement, dropTarget);
      break;


    case 'reactivo':
        // cuándo interactuen con el agua
      handleReactivoInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'portaobjetos':
        // cuándo interactuen con el agua
      handlePortaObjetoInteraction(droppedType, droppedElement, dropTarget);
      break;

      case 'pann':

      handlePanInteraction(droppedType, droppedElement, dropTarget);
      break;

      case 'tomatte':

      handleTomateInteraction(droppedType, droppedElement, dropTarget);
      break;

      case 'fressa':

      handleFresaInteraction(droppedType, droppedElement, dropTarget);
      break;

    case 'microscopio':
      handleMicroscopioInteraction(droppedType, droppedElement, dropTarget);
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




// INTERACCION CON EL AGUA
function handleReactivoInteraction(elementType, soltadoEnReactivo, YoReactivo) {
  switch(elementType) {
      case 'gotero':
          // Validación inicial
          if (soltadoEnReactivo.find('.punta_gotero').hasClass('tiene_gota_de_hidroxido_de_potasio') ||
              soltadoEnReactivo.find('.punta_gotero').hasClass('tiene_gota_de_azul_de_metileno')) {

              alert('El gotero ya tiene una sustancia.');

              // Remover ambas clases
              soltadoEnReactivo.find('.punta_gotero')
                  .removeClass('tiene_gota_de_hidroxido_de_potasio')
                  .removeClass('tiene_gota_de_azul_de_metileno');

              return; // Salimos del case para no continuar con el resto del código
          }

          // Resto del código original
          if (YoReactivo.hasClass("hidroxido_de_potasio")){
              soltadoEnReactivo.find('.punta_gotero').css('background-color', '#7F8082');
              soltadoEnReactivo.find('.punta_gotero').addClass("tiene_gota_de_hidroxido_de_potasio");
          }
          if (YoReactivo.hasClass("azul_de_metileno")){
              soltadoEnReactivo.find('.punta_gotero').css('background-color', '#2a6ce8');
              soltadoEnReactivo.find('.punta_gotero').addClass("tiene_gota_de_azul_de_metileno");
          }
          break;
  }
}

// ACCION PARA LA CINTA CON EL PAN
function handlePanInteraction(elementType, soltado_Pan, YoPan) {
    switch(elementType) {
        case 'cinta':
            if (!soltado_Pan.hasClass("usado")) {
                $("#parte1 p").html(`${elementType} añadido al pan`);
                if (!soltado_Pan.find(".muestra_de_pan_con_mobo").length > 0) {
                  soltado_Pan.append('<div class="muestra_de_pan_con_mobo"></div>');
                  soltado_Pan.addClass('usado');
                  soltado_Pan.attr('tipo_muestra', 'muestra_pan');
                }
                else{
                  alert("La cinta ya tiene la muestra.");

                }
            }else{
              alert("La cinta ya está usada.");
            }
            break;

    }
}

// ACCION PARA LA CINTA CON EL TOMATE
function handleTomateInteraction(elementType, soltado_Tomate, YoTomate) {
    switch(elementType) {
        case 'cinta':
            if (!soltado_Tomate.hasClass("usado")) {
                $("#parte1 p").html(`${elementType} añadido al tómate`);
                if (!soltado_Tomate.find(".muestra_de_tomate_con_mobo").length > 0) {
                  soltado_Tomate.append('<div class="muestra_de_tomate_con_mobo"></div>');
                  soltado_Tomate.addClass('usado');
                  soltado_Tomate.attr('tipo_muestra', 'muestra_tomate');
                }
                else{
                  alert("La cinta ya tiene la muestra.");

                }
            }else{
              alert("La cinta ya está usada.");
            }
            break;

    }
}

// ACCION PARA LA CINTA CON LA FRESA
function handleFresaInteraction(elementType, soltado_Fresa, YoFresa) {
    switch(elementType) {
        case 'cinta':
            if (!soltado_Fresa.hasClass("usado")) {
                $("#parte1 p").html(`${elementType} añadido al tómate`);
                if (!soltado_Fresa.find(".muestra_de_fresa_con_mobo").length > 0) {
                  soltado_Fresa.append('<div class="muestra_de_fresa_con_mobo"></div>');
                  soltado_Fresa.addClass('usado');
                  soltado_Fresa.attr('tipo_muestra', 'muestra_fresa');
                }
                else{
                  alert("La cinta ya tiene la muestra.");

                }
            }else{
              alert("La cinta ya está usada.");
            }
            break;

    }
}

// INTERACCION CON EL AGUA
function handlePortaObjetoInteraction(elementType, soltado_enPortaObjeto, YoPortaObjeto) {
    switch(elementType) {
        case 'gotero':
          if (!YoPortaObjeto.hasClass("usado")) {
            if (soltado_enPortaObjeto.find(".tiene_gota_de_hidroxido_de_potasio").length > 0) {
                if (!YoPortaObjeto.find(".gota_KOH").length > 0) {
                    YoPortaObjeto.append('<div class="gota_KOH"></div>').attr("tiene_gota_KOH", "si");
                    YoPortaObjeto.addClass("usado");
                    return;
                }
            }

            if (soltado_enPortaObjeto.find(".tiene_gota_de_azul_de_metileno").length > 0) {
                if (!YoPortaObjeto.find(".gota_AM").length > 0) {
                    YoPortaObjeto.append('<div class="gota_AM"></div>').attr("tiene_gota_AM", "si");
                    YoPortaObjeto.addClass("usado");
                    return;
                }
            }
            }else{
              alert("El portaobjetos no se puede usar.");
            }
            break; // Break for 'pipeta'

        case 'cinta':
          if (!YoPortaObjeto.find('.gota_AM').length > 0)
          {
            alert("No hay gota de reactivo Azul de Metileno para continuar");
            return;
          }

            if (!YoPortaObjeto.hasClass("usado") || YoPortaObjeto.find('.gota_KOH').length > 0 || YoPortaObjeto.find('.gota_AM').length > 0) {

              if (soltado_enPortaObjeto.find(".muestra_de_pan_con_mobo, .muestra_de_tomate_con_mobo, .muestra_de_fresa_con_mobo").length > 0) {
                  // Obtener dimensiones
                  let containerWidth = YoPortaObjeto.width();
                  let containerHeight = YoPortaObjeto.height();
                  let elementWidth = soltado_enPortaObjeto.width();
                  let elementHeight = soltado_enPortaObjeto.height();

                  // Calcular posición centrada
                  let topPosition = (containerHeight - elementHeight) / 2;
                  let leftPosition = (containerWidth - elementWidth) / 2;

                  // Aplicar posición
                  soltado_enPortaObjeto.css({
                      position: 'absolute',
                      top: topPosition,
                      left: leftPosition
                  });

                  // Hacer el append
                  YoPortaObjeto.append(soltado_enPortaObjeto);
                  var tipo_muestra = soltado_enPortaObjeto.attr('tipo_muestra');
                  YoPortaObjeto.addClass("usado"+tipo_muestra);
              }
            }else{
              alert("El portaobjetos ya tiene una muestra.");
            }


            break;
            case 'caspa':
              if (!YoPortaObjeto.hasClass("usado") || YoPortaObjeto.find('.gota_KOH').length > 0) {
                if(YoPortaObjeto.find('.gota_KOH').length > 0 ){
                      if(!YoPortaObjeto.hasClass('TieneMuestraCaspa')){
                          YoPortaObjeto.addClass("TieneMuestraCaspa");
                          soltado_enPortaObjeto.remove();
                          alert("Muestra de caspa aplicada");
                      }else{alert("Ya se aplicó la muestra de caspa sobre el PortaObjetos"); soltado_enPortaObjeto.remove();}
                }else{
                  alert("Para usar la caspa primero debe aplicar una gota de Hidróxido de potasio en el PortaObjetos");
                }

              }else{
                alert("El portaobjetos no se puede usar");
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



// CUANDO SE SUELTA EN EL MICROSCOPIO
function handleMicroscopioInteraction(elementType, soltado_enMicroscopio, YoMicroscopio) {
  if (elementType === 'portaobjetos') {


    // Aplicar zoom suave
    $(YoMicroscopio).addClass('zoom-in');

    // Crear pantalla negra con círculo de microscopio
    const microscopeView = $('<div id="microscopeView" class="microscope-view">').appendTo('body');
    const circle = $('<div class="microscope-circle">').appendTo(microscopeView);

    // Función para cambiar la imagen según el objetivo
    function changeImage(objective) {
      circle.empty(); // Limpiar contenido existente
      const imageContainer = $('<div class="microscope-image">').appendTo(circle);

      // Aquí puedes definir diferentes imágenes para cada objetivo
      let imagePath;
      switch(objective) {
        case '4X':
          imagePath = '/assets/images/no_disponible.jpg';
          break;
        case '10X':
          imagePath = '/assets/images/no_disponible.jpg';
          break;
        case '40X':

          if(soltado_enMicroscopio.find(".cinta").attr("tipo_muestra") == "muestra_pan"){
            imagePath = '/assets/images/muestra_pan.jpg';
          }

         else if(soltado_enMicroscopio.find(".cinta").attr("tipo_muestra") == "muestra_fresa"){
            imagePath = '/assets/images/muestra_fresa.jpg';
          }
       else if(soltado_enMicroscopio.find(".cinta").attr("tipo_muestra") == "muestra_tomate"){
            imagePath = '/assets/images/muestra_tomate.jpg';
          }

       else if(soltado_enMicroscopio.hasClass("TieneMuestraCaspa")){
            imagePath = '/assets/images/muestra_caspa.jpg';
          }

        else {
          imagePath = '/assets/images/no_disponible.jpg';
        }
          break;
        case '100X':
          imagePath = '/assets/images/no_disponible.jpg';
          break;
      }

      imageContainer.css({
        'background-image': `url(${imagePath})`,
        'background-size': 'cover',
        'background-position': 'center',
        'width': '100%',
        'height': '100%'
      });
    }

    // Crear botones para los objetivos
    const objectiveButtons = $('<div class="objective-buttons">').appendTo(microscopeView);
    ['4X', '10X', '40X', '100X'].forEach(objective => {
      $('<button>').text(objective).appendTo(objectiveButtons).click(() => {
        changeImage(objective);
      });
    });

    // Mostrar imagen inicial (4X por defecto)
    changeImage('40X');

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