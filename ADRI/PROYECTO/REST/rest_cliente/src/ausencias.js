/**
 * Actualiza los campos de hora de inicio y fin según las sesiones seleccionadas.
 * - Recoge los checkboxes marcados con name="sesiones[]".
 * - Ordena las sesiones por hora de inicio.
 * - Asigna la hora más temprana a `#hora_inicio` y la más tardía a `#hora_fin`.
 * - También actualiza los inputs ocultos para envío en formulario.
 *
 * @function actualizarHoras
 * @returns {void}
 */
function actualizarHoras() {
    // Obtener todos los checkboxes de sesiones marcados
    var checkboxesSeleccionados = document.querySelectorAll('input[name="sesiones[]"]:checked');
    console.log(checkboxesSeleccionados);

    if (checkboxesSeleccionados.length > 0) {
        /** @type {Array<[string, string]>} Array de pares [horaInicio, horaFin] */
        var horas = [];

        // Recorrer cada checkbox marcado y extraer rango de horas
        checkboxesSeleccionados.forEach(checkbox => {
            // El valor es "HH:MM - HH:MM"
            var hora = checkbox.value.split(' - ');
            horas.push(hora);
        });

        // Ordenar por hora de inicio
        horas.sort(function(a, b) {
            // Comparamos fechas ficticias para ordenar correctamente
            return new Date('1970/01/01 ' + a[0]) - new Date('1970/01/01 ' + b[0]);
        });

        // Asignar valores a los inputs visibles
        document.getElementById('hora_inicio').value = horas[0][0];
        document.getElementById('hora_fin').value   = horas[horas.length - 1][1];

        // Asignar valores a los inputs ocultos del formulario
        document.querySelector('input[name="hora_inicio"]').value = horas[0][0];
        document.querySelector('input[name="hora_fin"]').value   = horas[horas.length - 1][1];
    } else {
        // Sin sesiones seleccionadas: limpiar campos
        document.getElementById('hora_inicio').value = '';
        document.getElementById('hora_fin').value   = '';
        document.querySelector('input[name="hora_inicio"]').value = '';
        document.querySelector('input[name="hora_fin"]').value   = '';
    }
}

/**
 * Añade un listener de cambio a cada checkbox de sesión para disparar `actualizarHoras`.
 *
 * @function initSesionListeners
 * @returns {void}
 */
function initSesionListeners() {
    document.querySelectorAll('input[name="sesiones[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', actualizarHoras);
    });
}

/**
 * Controla el checkbox "Jornada Completa":
 * - Al marcarlo, selecciona/desmarca todas las sesiones.
 * - Actualiza las horas tras el cambio.
 *
 * @function initJornadaCompleta
 * @returns {void}
 */
function initJornadaCompleta() {
    var jornadaCompleta = document.getElementById('jornada_completa');
    var checkboxes = document.querySelectorAll('input[name="sesiones[]"]');

    jornadaCompleta.addEventListener('change', function() {
        // Marcar o desmarcar todos los checkboxes según estado
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = jornadaCompleta.checked;
        });
        // Actualizar campos de hora
        actualizarHoras();
    });
}

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    initSesionListeners();
    initJornadaCompleta();
    // Realizamos una actualización inicial por si hay preselecciones
    actualizarHoras();
});
