// Configuración de las placas petri
const config = {
    prePrac2: {
        dishClass: 'petridish_pre_prac2',
        microorganismClass: 'microorganism_petridish_pre_prac2',
        minMicroorganisms: 10,
        maxMicroorganisms: 24,
        multiColor: true
    },
    prac2: {
        dishClass: 'petridish_p2',
        microorganismClass: 'microorganism_petridish_prac2',
        minMicroorganisms: 10,
        maxMicroorganisms: 24,
        multiColor: false
    }
};

// Función para obtener un color aleatorio
function getRandomColor() {
    return `hsl(${Math.random() * 360}, 100%, 50%)`;
}

// Función para crear un microorganismo
function createMicroorganism(petriDish, microorganismClass, color) {
    const microorganism = document.createElement('div');
    microorganism.className = microorganismClass;

    const size = Math.random() * 6 + 2; // Tamaño entre 2px y 8px
    const top = Math.random() * 60 + 20; // Posición entre 20% y 80%
    const left = Math.random() * 60 + 20; // Posición entre 20% y 80%

    Object.assign(microorganism.style, {
        width: `${size}px`,
        height: `${size}px`,
        top: `${top}%`,
        left: `${left}%`,
        backgroundColor: color
    });

    petriDish.appendChild(microorganism);
}

// Función para simular microorganismos para una sola placa Petri
function simulateMicroorganismsForDish(petriDish, settings) {
    const numMicroorganisms = Math.floor(Math.random() * (settings.maxMicroorganisms - settings.minMicroorganisms + 1)) + settings.minMicroorganisms;
    const dishColor = settings.multiColor ? null : getRandomColor();

    for (let i = 0; i < numMicroorganisms; i++) {
        const color = settings.multiColor ? getRandomColor() : dishColor;
        createMicroorganism(petriDish, settings.microorganismClass, color);
    }
}

// Función para simular microorganismos para todas las placas Petri
function simulateAllMicroorganisms() {
    Object.values(config).forEach(settings => {
        const petriDishes = document.querySelectorAll(`.${settings.dishClass}`);
        petriDishes.forEach(dish => simulateMicroorganismsForDish(dish, settings));
    });
}

// Ejecutar la simulación cuando se carga la página
window.addEventListener('load', simulateAllMicroorganisms);


$(document).ready(function() {
    $(document).on('click', '.grifo', function(event){
        $(this).toggleClass('on');
        $(this).find('.agua_grifo').toggleClass('flowingGrifo');
    });
});