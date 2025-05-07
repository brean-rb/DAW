/**
 * Se ejecuta cuando el DOM ha sido completamente cargado y parseado.
 *
 * @param {Event} event - El evento DOMContentLoaded.
 * @returns {void}
 */
document.addEventListener("DOMContentLoaded", function () {
  // Selecciona el botón que dispara el toggle del menú (ícono hamburguesa)
  const toggleButton = document.querySelector('.navbar-toggler');
  // Obtiene el contenedor del menú de navegación que se mostrará u ocultará
  const menuContent = document.getElementById('navbarContent');

  /**
   * Manejador de clic para alternar la visibilidad del menú.
   *
   * @param {MouseEvent} event - El evento de clic disparado en el botón toggler.
   * @returns {void}
   */
  toggleButton.addEventListener('click', function () {
    // Alterna la clase 'show': si está presente la quita (oculta el menú), si no la añade (muestra el menú)
    menuContent.classList.toggle('show');
  });
});
