    function mezclarColoresHex(color1, color2) {
    // Función para convertir hex a RGB
    function hexAdec(hex) {
        return parseInt(hex, 16);
    }

    // Función para convertir RGB a hex
    function decAhex(dec) {
        let hex = dec.toString(16);
        return hex.length === 1 ? "0" + hex : hex; // Asegura que sea de dos caracteres
    }

    // Quita el símbolo # si está presente
    color1 = color1.replace("#", "");
    color2 = color2.replace("#", "");

    // Extrae los valores RGB de cada color
    const r1 = hexAdec(color1.substring(0, 2));
    const g1 = hexAdec(color1.substring(2, 4));
    const b1 = hexAdec(color1.substring(4, 6));

    const r2 = hexAdec(color2.substring(0, 2));
    const g2 = hexAdec(color2.substring(2, 4));
    const b2 = hexAdec(color2.substring(4, 6));

    // Mezcla los componentes RGB
    const rFinal = Math.round((r1 + r2) / 2);
    const gFinal = Math.round((g1 + g2) / 2);
    const bFinal = Math.round((b1 + b2) / 2);

    // Convierte los componentes RGB mezclados a formato hexadecimal
    const colorFinal = "#" + decAhex(rFinal) + decAhex(gFinal) + decAhex(bFinal);

    return colorFinal;
}



// Función para convertir rgb() a hex:

function rgbAHex(rgb) {
    // Extrae los valores R, G, B
    const rgbArray = rgb.match(/\d+/g);

    if (!rgbArray) return null;

    return "#" + rgbArray.map(x => {
        // Convierte cada valor R, G, B a hexadecimal
        let hex = parseInt(x).toString(16);
        // Asegura que el valor tenga dos caracteres
        return hex.length === 1 ? "0" + hex : hex;
    }).join("");
}




$(document).ready(function() {

// Selecciona el elemento donde se mostrarán las coordenadas
const coordinatesDisplay = document.getElementById('coordinates');

// Selecciona el contenedor workspace-inner
const workspaceInner = document.querySelector('.workspace-inner');

// Escucha el evento 'mousemove' en el contenedor
workspaceInner.addEventListener('mousemove', function(event) {
    // Obtiene las coordenadas relativas al contenedor
    const x = event.offsetX;
    const y = event.offsetY;

    // Actualiza el contenido del <p> con las coordenadas
    coordinatesDisplay.textContent = `X: ${x}, Y: ${y}`;
});




    let activeTooltip = null;

    // Función para mostrar el tooltip
    function showTooltip(event) {
        const $target = $(event.currentTarget);
        const description = $target.attr('description');

        if (!description) return;

        hideAllTooltips();

        const $tooltip = $('<div>').addClass('tooltip-modal').text(description);
        $('body').append($tooltip);

        const targetRect = $target[0].getBoundingClientRect();
        const tooltipRect = $tooltip[0].getBoundingClientRect();

        let left = targetRect.right + 10;
        if (left + tooltipRect.width > window.innerWidth) {
            left = targetRect.left - tooltipRect.width - 10;
        }
        left = Math.max(10, left);

        let top = targetRect.top + (targetRect.height / 2) - (tooltipRect.height / 2);
        top = Math.max(10, top);
        top = Math.min(window.innerHeight - tooltipRect.height - 10, top);

        $tooltip.css({left: left + 'px', top: top + 'px'});

        setTimeout(() => {
            $tooltip.addClass('show');
        }, 10);

        activeTooltip = $tooltip;
    }

    // Función para ocultar todos los tooltips
    function hideAllTooltips() {
        $('.tooltip-modal').remove();
        activeTooltip = null;
    }

    // Usar delegación de eventos para manejar elementos actuales y futuros
    $(document).on({
        mouseenter: showTooltip,
        mouseleave: hideAllTooltips
    }, '.drag[description]');

    // Ocultar todos los tooltips cuando el mouse no está sobre ningún elemento .drag
    $(document).on('mousemove', function(event) {
        const $target = $(event.target);
        if (!$target.closest('.drag[description]').length) {
            hideAllTooltips();
        }
    });

    // Ocultar tooltips durante el arrastre
    $(document).on('dragstart', '.drag', hideAllTooltips);



});