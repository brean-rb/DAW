/**
 * Se ejecuta cuando el DOM ha sido completamente cargado y parseado.
 *
 * @param {Event} event - Evento DOMContentLoaded que indica que el DOM está listo.
 * @returns {void}
 */
document.addEventListener('DOMContentLoaded', (/* event */) => {
  // Formulario oculto para consulta de profesores
  const hiddenForm = document.getElementById('formConsultaProfes');

  // Si existe el formulario y no se ha enviado antes, lo envía y marca en localStorage
  if (hiddenForm && !localStorage.getItem('consultaProfesRealizada')) {
      hiddenForm.submit();
      localStorage.setItem('consultaProfesRealizada', 'true');
  }

  // Select que determina el tipo de informe a mostrar
  const tipoSelect = document.getElementById('tipoInforme');

  // Mapeo de tipos a sus campos correspondientes en el DOM
  const campos = {
    dia: document.getElementById('campo-dia'),
    semana: document.getElementById('campo-semana'),
    mes: document.getElementById('campo-mes'),
    trimestre: document.getElementById('campo-trimestre'),
    docent: document.getElementById('campo-docent')
  };

  /**
   * Oculta todos los campos de informe y muestra únicamente
   * el campo correspondiente al tipo seleccionado.
   *
   * @returns {void}
   */
  function actualizarCampos() {
    // Oculta todos los campos
    Object.values(campos).forEach(campo => {
      campo.style.display = 'none';
    });

    // Muestra el campo asociado al valor actual del select, si existe
    const seleccionado = tipoSelect.value;
    if (seleccionado && campos[seleccionado]) {
      campos[seleccionado].style.display = 'block';
    }
  }

  /**
   * Manejador del evento 'change' en el select de tipo de informe.
   *
   * @param {Event} event - Evento que indica cambio de selección.
   * @returns {void}
   */
  tipoSelect.addEventListener('change', actualizarCampos);

  // Inicializa la visibilidad correcta al cargar la página
  actualizarCampos();
});
