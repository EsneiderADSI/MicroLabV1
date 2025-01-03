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
            $(document).on('click', '.grifo', function(event){
                $(this).toggleClass('on');
                $(this).find('.agua_grifo').toggleClass('flowingGrifo');
            });

  $(document).on('click', '.door_nevera', function(event){
            var isOpen = $(this).hasClass('open');

            if (isOpen) {
                $(this).removeClass('open').css('transform', 'rotateY(0deg)');
            } else {
                $(this).addClass('open').css('transform', 'rotateY(-100deg)');
            }
        });
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


        function addMicroorganismsToTube($tube, count) {
            const colors = ['#8B4513', '#006400', '#4B0082', '#FF4500', '#1E90FF', '#FF69B4', '#32CD32', '#FF8C00', '#9932CC', '#8B0000'];
            const $liquido = $tube.find('.liquido-tubo_micro');
            const liquidoHeight = $liquido.height();
            const liquidoTop = $liquido.position().top;

            for (let i = 0; i < count; i++) {
                const $microorganism = $('<div>').addClass('microorganismo_micro');

                const top = Math.random() * liquidoHeight + liquidoTop;
                const left = Math.random() * 28 + 1; // 1px de margen en cada lado
                const size = Math.random() * 3 + 2;
                const color = colors[Math.floor(Math.random() * colors.length)];

                $microorganism.css({
                    top: `${top}px`,
                    left: `${left}px`,
                    width: `${size}px`,
                    height: `${size}px`,
                    backgroundColor: color
                });

                $tube.append($microorganism);
            }
        }

        // Añadir microorganismos a todos los tubos de ensayo
        $('.tubo-ensayo-container_micro').each(function() {
            addMicroorganismsToTube($(this), 20); // 20 microorganismos por tubo
        });



});





// ESTILOS PARA LA LLAVE DE GRIFO

