/**
 * Añade un listener al botón de exportar PDF para generar un informe filtrado
 * e incluir un logo en el pie de cada página.
 *
 * @param {Event} event - Evento 'click' disparado en el botón exportarPDF.
 * @returns {void}
 */
document.getElementById("exportarPDF").addEventListener("click", function () {
  // Selecciona el elemento que contiene la tabla a exportar
  const contenido = document.querySelector(".tabla2PDF");
  // Selecciona el elemento del logo que se añadirá en el footer del PDF
  const footerLogo = document.getElementById("footerLogo");

  // Configuración de opciones para html2pdf
  const opt = {
    margin: [10, 10, 30, 10],            // Márgenes [top, left, bottom, right] en mm (bottom mayor para logo)
    filename: 'informe-filtrado.pdf',    // Nombre del archivo resultante
    image: { type: 'jpeg', quality: 1 }, // Tipo y calidad de imagen
    html2canvas: { scale: 4, useCORS: true }, // Opciones para html2canvas
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } // Configuración jsPDF
  };

  // Genera el PDF a partir del contenido y obtiene la instancia jsPDF
  html2pdf().set(opt).from(contenido).toPdf().get('pdf')
    /**
     * Callback ejecutado una vez generado el PDF.
     *
     * @param {object} pdf - Instancia de jsPDF con el documento generado.
     * @returns {void}
     */
    .then(function (pdf) {
      // Número total de páginas del PDF
      const totalPages = pdf.internal.getNumberOfPages();
      // Dimensiones de la página en las unidades definidas (mm)
      const pageWidth = pdf.internal.pageSize.getWidth();
      const pageHeight = pdf.internal.pageSize.getHeight();
      // Dimensiones del logo a insertar (en mm)
      const logoWidth = 40;
      const logoHeight = 20; // Altura ligeramente mayor para mejor visibilidad
      // Cálculo de posición X (centrado)
      const x = (pageWidth - logoWidth) / 2;
      // Cálculo de posición Y (10mm por encima del borde inferior)
      const y = pageHeight - logoHeight - 10;

      // Recorre cada página y añade el logo en el pie
      for (let i = 1; i <= totalPages; i++) {
        pdf.setPage(i); // Selecciona la página actual
        pdf.addImage(footerLogo, 'PNG', x, y, logoWidth, logoHeight); // Inserta el logo
      }
    })
    .save(); // Guarda y descarga el PDF automáticamente
});
