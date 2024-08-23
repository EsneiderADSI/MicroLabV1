// Código para mostrar Tooltip o ventanita negrita emergente sobre objetos INICIO
document.addEventListener('DOMContentLoaded', () => {
    const drags = document.querySelectorAll('.drag');

    drags.forEach(drag => {
        drag.addEventListener('mouseenter', showTooltip);
        drag.addEventListener('mouseleave', hideTooltip);
    });

    function showTooltip(event) {
        const description = event.target.getAttribute('description');
        const tooltip = document.createElement('div');
        tooltip.classList.add('tooltip-modal');
        tooltip.innerText = description;

        document.body.appendChild(tooltip);

        const rect = event.target.getBoundingClientRect();
        const tooltipRect = tooltip.getBoundingClientRect();

        let left = rect.right + 10;
        if (left + tooltipRect.width > window.innerWidth) {
            left = rect.left - tooltipRect.width - 10;
        }
        if (left < 0) {
            left = 10;
        }

        let top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
        if (top < 10) {
            top = 10;
        }
        if (top + tooltipRect.height > window.innerHeight) {
            top = window.innerHeight - tooltipRect.height - 10;
        }

        tooltip.style.left = `${left}px`;
        tooltip.style.top = `${top}px`;

        setTimeout(() => {
            tooltip.classList.add('show');
        }, 10);

        event.target.tooltipElement = tooltip;
    }

    function hideTooltip(event) {
        const tooltip = event.target.tooltipElement;
        if (tooltip) {
            tooltip.classList.remove('show');
            setTimeout(() => {
                tooltip.remove();
            }, 300);
        }
    }
});

// Código para mostrar Tooltip o ventanita negrita emergente sobre objetos FIN