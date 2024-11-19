// Configuración de las placas petri
const config = {
    prePrac2: {
        dishClass: 'petridish_p4',
        microorganismClass: 'hongos_p4',
        minHongos: 10,
        maxHongos: 24,
        multiColor: true
    }
};

// Función para obtener un color aleatorio en tonos amarillentos y pálidos
function getRandomFungusColor() {
    const hue = Math.random() * 60; // Amarillo a amarillo pálido (40-100 en la rueda de color)
    const saturation = Math.random() * 40 + 60; // Saturación entre 60-100%
    const lightness = Math.random() * 40 + 40; // Luminosidad entre 40-80%
    return `hsl(${hue}, ${saturation}%, ${lightness}%)`;
}

// Función para crear un microorganismo (hongo)
function createFungus(petriDish, microorganismClass, color) {
    const fungus = document.createElement('div');
    fungus.className = microorganismClass;
    const size = Math.random() * 5 + 10; // Tamaño entre 10px y 20px
    const top = Math.random() * 60 + 10; // Posición entre 10% y 90%
    const left = Math.random() * 60 + 10; // Posición entre 10% y 90%
    Object.assign(fungus.style, {
        width: `${size}px`,
        height: `${size}px`,
        top: `${top}%`,
        left: `${left}%`,
        backgroundColor: color,
        borderRadius: '50%'
    });
    petriDish.appendChild(fungus);
}

// Función para simular hongos para una sola placa Petri
function simulateFungiForDish(petriDish, settings) {
    const numFungi = Math.floor(Math.random() * (settings.maxHongos - settings.minHongos + 1)) + settings.minHongos;
    for (let i = 0; i < numFungi; i++) {
        const color = getRandomFungusColor();
        createFungus(petriDish, settings.microorganismClass, color);
    }
}

// Función para simular hongos para todas las placas Petri
function simulateAllFungi() {
    Object.values(config).forEach(settings => {
        const petriDishes = document.querySelectorAll(`.${settings.dishClass}`);
        petriDishes.forEach(dish => simulateFungiForDish(dish, settings));
    });
}

// Ejecutar la simulación cuando se carga la página
window.addEventListener('load', simulateAllFungi);


$(document).ready(function() {
    $(document).on('click', '.grifo', function(event){
        $(this).toggleClass('on');
        $(this).find('.agua_grifo').toggleClass('flowingGrifo');
    });
});