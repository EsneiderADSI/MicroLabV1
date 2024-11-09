// Configuración de las placas petri
const config = {
    prePrac2: {
        dishClass: 'petridish_p3',
        muestraClass: 'heces_p3',
        minElements: 15, // Aumentamos el número mínimo para más realismo
        maxElements: 25, // Aumentamos el máximo para más densidad
        multiColor: true
    }
};

// Paleta de colores realista para muestras fecales
const fecalColors = [
    'rgb(101, 67, 33)',  // Marrón oscuro
    'rgb(139, 69, 19)',  // Marrón saddle
    'rgb(160, 82, 45)',  // Marrón siena
    'rgb(165, 42, 42)',  // Marrón rojizo
    'rgb(128, 70, 27)',  // Marrón tierra
    'rgb(89, 60, 31)',   // Marrón oscuro
    'rgba(139, 0, 0, 0.7)', // Rojo oscuro semi-transparente para simular sangre
];

// Función para obtener un color aleatorio de la paleta
function getRandomFecalColor() {
    return fecalColors[Math.floor(Math.random() * fecalColors.length)];
}

// Función para crear formas aleatorias de muestras
function createHeces(petriDish, muestraClass, color) {
    const elemento = document.createElement('div');
    elemento.className = muestraClass;

    // Generamos formas más variadas y realistas
    const baseSize = Math.random() * 0.8 + 0.3; // Tamaños más pequeños entre 0.3px y 1.1px
    const width = baseSize * (Math.random() * 2 + 1); // Variación en el ancho
    const height = baseSize * (Math.random() * 2 + 1); // Variación en el alto

    // Posicionamiento más natural
    const top = Math.random() * 70 + 15; // Posición entre 15% y 85%
    const left = Math.random() * 70 + 15; // Posición entre 15% y 85%

    // Rotación aleatoria para más naturalidad
    const rotation = Math.random() * 360;

    // Aplicamos estilos más sofisticados
    Object.assign(elemento.style, {
        width: `${width}px`,
        height: `${height}px`,
        top: `${top}%`,
        left: `${left}%`,
        backgroundColor: color,
        borderRadius: `${Math.random() * 50}% ${Math.random() * 50}% ${Math.random() * 50}% ${Math.random() * 50}%`, // Bordes irregulares
        transform: `rotate(${rotation}deg)`,
        opacity: Math.random() * 0.3 + 0.7, // Variación en la opacidad
        boxShadow: `0 0 ${Math.random() * 0.5}px rgba(0,0,0,0.3)`, // Sombra sutil
        transition: 'all 0.3s ease' // Transición suave para cambios
    });

    // Agregamos ocasionalmente elementos que simulan sangre
    if (Math.random() < 0.15) { // 15% de probabilidad
        elemento.style.backgroundColor = 'rgba(139, 0, 0, 0.4)';
        elemento.style.filter = 'blur(0.2px)';
    }

    petriDish.appendChild(elemento);
}

// Función para simular muestras para una sola placa Petri
function simulateMicroorganismsForDish(petriDish, settings) {
    const numElements = Math.floor(Math.random() *
        (settings.maxElements - settings.minElements + 1)) + settings.minElements;

    // Limpiamos la placa antes de agregar nuevos elementos
    while (petriDish.firstChild) {
        petriDish.removeChild(petriDish.firstChild);
    }

    // Agregamos los elementos con variación en la distribución
    for (let i = 0; i < numElements; i++) {
        const color = getRandomFecalColor();
        createHeces(petriDish, settings.muestraClass, color);
    }
}

// Función para simular muestras en todas las placas Petri
function simulateAllMicroorganisms() {
    Object.values(config).forEach(settings => {
        const petriDishes = document.querySelectorAll(`.${settings.dishClass}`);
        petriDishes.forEach(dish => simulateMicroorganismsForDish(dish, settings));
    });
}

// Ejecutar la simulación cuando se carga la página
window.addEventListener('load', simulateAllMicroorganisms);

// Actualizar la simulación cada cierto tiempo para simular movimiento
setInterval(() => {
    simulateAllMicroorganisms();
}, 5000); // Actualiza cada 5 segundos