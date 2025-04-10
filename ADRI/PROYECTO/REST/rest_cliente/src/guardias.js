 window.onload = function() {
        // Simula un clic en el botón de "Cargar Guardias" cuando la página se carga
        document.getElementById('cargarGuardiasBtn').click();
    };

    document.addEventListener('DOMContentLoaded', function () {
        const modalElement = document.getElementById('coverGuardModal');
        const modal = new bootstrap.Modal(modalElement);
    
        document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
            button.addEventListener('click', function () {
                const sesionInfo = this.getAttribute('data-sesion');
                const sesionId = this.getAttribute('data-sesion-id');
                const documentValue = this.getAttribute('data-document');
    
                document.getElementById('sesion-info').textContent = "Vas a cubrir la guardia: " + sesionInfo;
                document.getElementById('sesion_id_input').value = sesionId;
                document.getElementById('document_input').value = documentValue;
            });
        });
    
        document.getElementById('confirm-cover').addEventListener('click', function() {
            modal.hide();
        });
    });
    