$(document).ready(function() {
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