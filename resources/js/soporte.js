// resources/js/soporte.js
console.log("Soporte.js cargado!");

document.addEventListener('DOMContentLoaded', function() {
    const supportForm = document.getElementById('soporte-form');
    if (!supportForm) return;

    const supportButton = supportForm.querySelector('button[type="submit"]');
    const originalButtonText = supportButton.innerHTML;
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


    supportForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(supportForm);

        // Animación de carga
        supportButton.innerHTML = `
            <div class="flex items-center justify-center">
                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
                Enviando...
            </div>
        `;
        supportButton.disabled = true;

        try {
            const response = await fetch(supportForm.action, { // Usamos la action del formulario (que es /soporte)
                method: 'POST',
                 headers: {
                     'X-CSRF-TOKEN': csrfToken,
                     'Accept': 'application/json', // Importante para que Laravel devuelva JSON
                     'X-Requested-With': 'XMLHttpRequest' // Indica que es una solicitud AJAX
                 },
                body: formData
            });

            // Si la respuesta no es OK, o la validación falló (422), aún así intenta leer el JSON
            const result = await response.json();

            if (response.ok && result.success) {
                // Éxito: Mostrar alerta y limpiar formulario
                alert(result.message);
                supportForm.reset();
            } else {
                // Error de validación o BD: Mostrar alerta de error
                alert(result.message || 'Error al enviar el mensaje.');
            }
        } catch (error) {
            console.error('Error en AJAX de soporte:', error);
            alert('Error de conexión. Intenta nuevamente.');
        } finally {
            // Restaurar botón
            supportButton.innerHTML = originalButtonText;
            supportButton.disabled = false;
        }
    });
});