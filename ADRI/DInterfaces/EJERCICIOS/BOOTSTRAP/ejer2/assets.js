var botonLat = document.getElementById("menuLat");
var menuPath = document.getElementById("menuPath");
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
botonLat.onclick = function () {
    if (
        menuPath.getAttribute("d") ===
        "M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"
    ) {
        menuPath.setAttribute(
            "d",
            "M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
        );
    } else {
        menuPath.setAttribute(
            "d",
            "M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"
        );
    }
};
document.getElementById("logo").addEventListener("click", function () {
    location.reload();
});
window.onscroll = function () {
    if (document.documentElement.scrollTop > 100) {
        document.getElementById("volverArriba").style.display = "block";
    } else {
        document.getElementById("volverArriba").style.display = "none";
    }
};

function actualizarFecha() {
    // Obtener el valor del select
    var fechaSeleccionada = document.getElementById("torneosDIs").value;
    
    // Verificar que se haya seleccionado una fecha válida
    if (fechaSeleccionada) {
        // Formatear la fecha al formato "dd-mm-aaaa"
        var partesFecha = fechaSeleccionada.split('-');
        var fechaFormateada = partesFecha[2] + '-' + partesFecha[1] + '-' + partesFecha[0];
        
        // Asignar la fecha formateada al input de tipo text
        document.getElementById("fecha").value = fechaFormateada;
    } else {
        // Si no hay selección, borrar el valor del input de fecha
        document.getElementById("fecha").value = '';
    }
}
document.querySelectorAll(".btn.btn-custom:not(.limpio)").forEach((button) => {    
    button.addEventListener("click", function () {
        // Identificar el modal actual basado en el botón presionado
        const modal = button.closest(".modal-content");

        // Obtener los valores de los campos en el modal
        const nombre = modal.querySelector("#name").value;
        const email = modal.querySelector("#email").value;
        const torneo = modal.querySelector("#torneosDIs").value;
        const fecha = modal.querySelector("#fecha");

        const fechasPermitidas = [
            "2025-01-20",
            "2025-02-15",
            "2025-03-10",
        ];

        // Validación y lógica
        // Verificar que todos los campos estén llenos y la fecha sea válida
        if (
            nombre !== "" &&
            email !== "" &&
            torneo !== "" &&
            fecha.value !== ""
        ) {
            const errorMessage = document.getElementById("errorMessage");
            const successMessage = document.getElementById("successMessage");

            // Verificar si la fecha seleccionada está en la lista de fechas permitidas
            if (fechasPermitidas.includes(fecha.value)) {
                // Mostrar mensaje de éxito
                successMessage.classList.add("show");
                setTimeout(() => {
                    successMessage.classList.remove("show");
                }, 3000);

                // Asegurarse de ocultar el mensaje de error si estaba visible
                errorMessage.classList.remove("show");
            } else {
                // Mostrar mensaje de error
                errorMessage.classList.add("show");
                setTimeout(() => {
                    errorMessage.classList.remove("show");
                }, 3000);

                // Asegurarse de ocultar el mensaje de éxito si estaba visible
                successMessage.classList.remove("show");
            }
        } else {
            // Mostrar mensaje de error si los campos están vacíos
            const errorMessage = document.getElementById("errorMessage");
            errorMessage.classList.add("show");
            setTimeout(() => {
                errorMessage.classList.remove("show");
            }, 3000);
        }
    });
});
