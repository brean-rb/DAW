function validarForm() {
    // Confirmar si el usuario quiere borrar el formulario
    if (!confirm('¿Estás seguro de que deseas borrar este formulario?')) {
        return false;
    }

    // Comprobar que los campos de contraseñas coinciden
    const campo1 = document.getElementById('campo1');
    const campo2 = document.getElementById('campo2');
    const mensaje = document.getElementById('mensaje');

    if (campo1 && campo2 && mensaje) {
        if (campo1.value !== campo2.value) {
            mensaje.textContent = 'Las contraseñas no coinciden';
            mensaje.style.color = 'red';
            return false;
        }
    }

    // Habilitar o deshabilitar el botón de submit según el campo
    const campoSubmit = document.getElementById('campoSubmit');
    const botonSubmit = document.getElementById('botonSubmit');

    if (campoSubmit && botonSubmit) {
        if (campoSubmit.value.trim() === '') {
            botonSubmit.disabled = true;
            return false;
        } else {
            botonSubmit.disabled = false;
        }
    }

    // Mostrar resumen y ocultar formulario
    const formulario = document.getElementById('formulario');
    const resumen = document.getElementById('resumen');

    if (formulario && resumen) {
        formulario.addEventListener('submit', (event) => {
            event.preventDefault();
            const datos = new FormData(formulario);
            const resumenHTML = Array.from(datos.entries())
                .map(([clave, valor]) => `<p><strong>${clave}:</strong> ${valor}</p>`)
                .join('');

            formulario.style.display = 'none';
            resumen.innerHTML = resumenHTML;
            resumen.style.display = 'block';
        });
    }

    // Función para poner el foco en el campo
    function ponerFoco(campoId) {
        const campo = document.getElementById(campoId);
        if (campo) {
            campo.focus();
        }
    }

    // Función para poner la primera letra de cada palabra en mayúscula
    function capitalizarEntrada(campoId) {
        const campo = document.getElementById(campoId);
        if (campo) {
            campo.addEventListener('input', () => {
                campo.value = campo.value
                    .toLowerCase()
                    .split(' ')
                    .map(palabra => palabra.charAt(0).toUpperCase() + palabra.slice(1))
                    .join(' ');
            });
        }
    }

    return true; // Si todo está bien, permitir el envío del formulario
}
