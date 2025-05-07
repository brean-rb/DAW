/**
 * Se ejecuta cuando la ventana termina de cargar.
 * Simula un clic en el botón "Cargar Guardias" si existe.
 *
 * @param {Event} event - Evento load de la ventana.
 * @returns {void}
 */
window.onload = function (event) {
    // Obtiene el botón para cargar guardias
    const cargarBtn = document.getElementById('cargarGuardiasBtn');
    if (cargarBtn) {
        // Simula un clic para disparar la carga automática
        cargarBtn.click();
    }
};

document.addEventListener('DOMContentLoaded', 
    /**
     * Se ejecuta cuando el DOM ha sido completamente cargado y parseado.
     * Inicializa la lógica del modal y la validación de selección de sesiones.
     *
     * @param {Event} event - Evento DOMContentLoaded.
     * @returns {void}
     */
    function (event) {
        // Lógica del modal para cubrir guardias
        const modalElement = document.getElementById('coverGuardModal');
        if (modalElement) {
            // Instancia de bootstrap.Modal para controlar el modal
            const modal = new bootstrap.Modal(modalElement);

            // Añade clic a todos los botones que abren el modal
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                /**
                 * Manejador de clic en botón que abre el modal de cubrir guardia.
                 *
                 * @param {MouseEvent} event - Evento de clic.
                 * @returns {void}
                 */
                button.addEventListener('click', function (event) {
                    // Recupera información de la sesión del atributo data
                    const sesionInfo   = this.getAttribute('data-sesion');
                    const sesionId     = this.getAttribute('data-sesion-id');
                    const documentValue= this.getAttribute('data-document');

                    // Muestra la información en el contenido del modal
                    document.getElementById('sesion-info').textContent = 
                        "Vas a cubrir la guardia: " + sesionInfo;
                    // Asigna valores ocultos para el envío del formulario
                    document.getElementById('sesion_id_input').value = sesionId;
                    document.getElementById('document_input').value   = documentValue;
                });
            });

            // Botón de confirmación cierra el modal
            document.getElementById('confirm-cover')?.addEventListener('click', 
                /**
                 * Manejador de clic en botón de confirmar cobertura.
                 *
                 * @param {MouseEvent} event - Evento de clic.
                 * @returns {void}
                 */
                function (event) {
                    modal.hide();
                }
            );
        }

        // Validar que se seleccione al menos una sesión antes de guardar ausencia
        const guardarBtn = document.getElementById("guardarAusencia");
        if (guardarBtn) {
            /**
             * Manejador de clic en botón de guardar ausencia.
             * Verifica selección de sesiones y ajusta checkbox de jornada completa.
             *
             * @param {MouseEvent} event - Evento de clic.
             * @returns {void}
             */
            guardarBtn.addEventListener("click", function (event) {
                const checkboxes   = document.querySelectorAll(".checkboxSesion");
                const seleccionadas= document.querySelectorAll(".checkboxSesion:checked");

                if (seleccionadas.length === 0) {
                    // Muestra alerta y evita el envío si no hay ninguna seleccionada
                    alert("Por favor, selecciona al menos una sesión.");
                    event.preventDefault();
                    return;
                }

                // Marca o desmarca el checkbox de jornada completa según la selección
                const jornadaCompleta = document.getElementById("jornada_completa");
                if (jornadaCompleta) {
                    jornadaCompleta.checked = (checkboxes.length === seleccionadas.length);
                }
            });
        }
    }
);
