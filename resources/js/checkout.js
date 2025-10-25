// resources/js/checkout.js
console.log("Checkout.js cargado!");

// --- DEFINICIONES DE FUNCIONES (FUERA DEL DOMCONTENTLOADED) ---
let csrfToken; // Definida fuera para ser accesible

// Función para escapar HTML (puede estar fuera)
function escapeHtml(unsafe) {
    if (typeof unsafe !== 'string') return "";
    return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}

// Función para actualizar el resumen (AHORA DEFINIDA FUERA)
async function updateOrderSummary() {
    console.log("Actualizando resumen del pedido...");
    // Obtenemos los elementos del resumen aquí, cuando se necesitan
    const summaryItemsContainer = document.getElementById('checkout-summary-items');
    const summarySubtotalEl = document.getElementById('checkout-summary-subtotal');
    const summaryShippingEl = document.getElementById('checkout-summary-shipping');
    const summaryTotalEl = document.getElementById('checkout-summary-total');

    // Obtenemos el token si aún no lo tenemos
    csrfToken = csrfToken || document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


    if (!summaryItemsContainer || !summarySubtotalEl || !summaryShippingEl || !summaryTotalEl) {
        console.error("Elementos del resumen de checkout no encontrados al actualizar.");
        return; // Salir si faltan elementos
    }
    summaryItemsContainer.innerHTML = '<p class="text-sm text-gray-500 text-center py-4">Cargando...</p>'; // Estado de carga

    try {
        const response = await fetch('/carrito', {
            method: 'GET',
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
        });
         if (!response.ok) throw new Error(`Error ${response.status}`);
        const result = await response.json();

        if (result.status === 'success' && result.carrito) {
            const items = result.carrito;
            let subtotal = 0;
            let itemsHTML = '';

            if (items.length === 0) {
                itemsHTML = '<p class="text-sm text-gray-500 text-center py-4">Tu carrito está vacío.</p>';
            } else {
                items.forEach(item => {
                     const price = parseFloat(item.pivot?.precio_unitario || item.precio_final || item.precio_oferta || item.precio);
                     subtotal += price * (item.pivot?.cantidad || 1);
                     
                     // --- INICIO CÓDIGO HTML MEJORADO ---
                     itemsHTML += `
                         <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0"> 
                             <div class="flex items-center space-x-3 flex-grow min-w-0 mr-4">
                                 <img src="${escapeHtml(item.imagen_url)}" 
                                      alt="${escapeHtml(item.nombre)}" 
                                      class="w-10 h-12 object-cover rounded border flex-shrink-0">
                                 
                                 <div class="flex-grow min-w-0">
                                     <p class="font-medium text-xs text-gray-700 truncate">${escapeHtml(item.nombre)}</p>
                                     <p class="text-xs text-gray-500">Talla: ${escapeHtml(item.talla)}</p>
                                 </div>
                             </div>
                             <span class="text-xs font-semibold text-gray-600 flex-shrink-0">$${price.toFixed(2)}</span>
                         </div>`;
                     // --- FIN CÓDIGO HTML MEJORADO ---
                 });
            }

            summaryItemsContainer.innerHTML = itemsHTML;
            const shippingCost = 10.00;
            const total = subtotal + shippingCost;

            summarySubtotalEl.textContent = `$${subtotal.toFixed(2)}`;
            summaryShippingEl.textContent = `$${shippingCost.toFixed(2)}`;
            summaryTotalEl.textContent = `$${total.toFixed(2)}`;

            // Aseguramos obtener el form aquí también
            const checkoutForm = document.getElementById('checkout-form');
            const submitButton = checkoutForm?.querySelector('button[type="submit"]');
            if (submitButton) submitButton.disabled = items.length === 0;

        } else {
            throw new Error(result.message || "No se pudo cargar el carrito.");
        }
    } catch (error) {
        console.error("Error al actualizar resumen:", error);
         // Aseguramos obtener los elementos aquí también para el estado de error
        const summaryItemsContainer = document.getElementById('checkout-summary-items');
        const summarySubtotalEl = document.getElementById('checkout-summary-subtotal');
        const summaryShippingEl = document.getElementById('checkout-summary-shipping');
        const summaryTotalEl = document.getElementById('checkout-summary-total');
        if(summaryItemsContainer) summaryItemsContainer.innerHTML = '<p class="text-sm text-red-500 text-center py-4">Error al cargar el carrito.</p>';
        if(summarySubtotalEl) summarySubtotalEl.textContent = '$0.00';
        if(summaryShippingEl) summaryShippingEl.textContent = '$0.00';
        if(summaryTotalEl) summaryTotalEl.textContent = '$0.00';
        const checkoutForm = document.getElementById('checkout-form');
        const submitButton = checkoutForm?.querySelector('button[type="submit"]');
        if (submitButton) submitButton.disabled = true;
    }
} // Fin de updateOrderSummary


function openCheckoutModal() {
    console.log("Abriendo modal de checkout...");
    const overlay = document.getElementById('checkout-overlay');
    const panel = document.getElementById('checkout-panel');

    if (typeof window.closeSideCart === 'function') { window.closeSideCart(); }

    if (overlay && panel) {
        updateOrderSummary(); // AHORA ESTA FUNCIÓN ES ACCESIBLE
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
        requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
            panel.classList.remove('opacity-0', 'scale-95');
        });
    } else {
         console.error("No se encontraron los elementos checkoutOverlay o checkoutPanel al intentar ABRIR.");
    }
}

function closeCheckoutModal() {
    console.log("Cerrando modal de checkout...");
    const overlay = document.getElementById('checkout-overlay');
    const panel = document.getElementById('checkout-panel');

    if (overlay && panel) {
        panel.classList.add('opacity-0', 'scale-95');
        overlay.classList.add('opacity-0');
        setTimeout(() => {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            const cartPanel = document.getElementById('cart-panel');
             if (!cartPanel || cartPanel.classList.contains('translate-x-full')) {
                 document.body.style.overflow = '';
             }
        }, 300);
    } else {
        console.error("No se encontraron los elementos checkoutOverlay o checkoutPanel al intentar CERRAR.");
    }
}

// --- ASIGNACIÓN GLOBAL ---
window.openCheckoutModal = openCheckoutModal;

// --- CÓDIGO QUE NECESITA EL DOM (DENTRO DEL DOMCONTENTLOADED) ---
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM cargado, asignando listeners y elementos de checkout...");

    // Obtenemos elementos para listeners
    const closeCheckoutBtn = document.getElementById('close-checkout-button');
    const checkoutForm = document.getElementById('checkout-form');
    const checkoutOverlay = document.getElementById('checkout-overlay');
    // Obtenemos el token CSRF una vez que el DOM está listo
    csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


    // --- Manejar envío del formulario (DEFINIDO DENTRO) ---
    async function handleCheckoutSubmit(event) {
        event.preventDefault();
        console.log("Enviando formulario de checkout...");
        // ... (resto del código de handleCheckoutSubmit sin cambios) ...
        const form = event.target;
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        if (submitButton) submitButton.disabled = true;

        try {
            const response = await fetch('/pedido', {
                method: 'POST',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: formData
            });
            const result = await response.json();
            if (response.ok && result.status === 'success') {
                console.log("Pedido realizado con éxito:", result);
                window.location.href = `/pedido/exito/${result.pedido_id}`;
            } else {
                console.error("Error al procesar pedido:", result);
                 let errorMessage = result.message || 'Error desconocido al procesar el pedido.';
                 if (response.status === 422 && result.errors) {
                     errorMessage = "Por favor, revisa los datos de envío.";
                 }
                alert(errorMessage);
                if (submitButton) submitButton.disabled = false;
            }
        } catch (error) {
            console.error('Error de red durante el checkout:', error);
            alert('Hubo un problema de conexión al procesar tu pedido.');
            if (submitButton) submitButton.disabled = false;
        }
    } // Fin de handleCheckoutSubmit


    // --- Asignar Event Listeners (DENTRO DEL DOMCONTENTLOADED) ---
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', handleCheckoutSubmit);
        console.log("Listener de submit añadido al formulario de checkout.");
    } else { console.warn("No se encontró el formulario #checkout-form."); }

    if (closeCheckoutBtn) {
        closeCheckoutBtn.addEventListener('click', closeCheckoutModal);
        console.log("Listener de clic añadido al botón de cerrar checkout.");
    } else { console.warn("No se encontró el botón #close-checkout-button."); }

    if (checkoutOverlay) {
        checkoutOverlay.addEventListener('click', (e) => { if (e.target === checkoutOverlay) { closeCheckoutModal(); } });
        console.log("Listener de clic añadido al overlay de checkout.");
    } else { console.warn("No se encontró el elemento #checkout-overlay."); }

     console.log("Listeners de checkout añadidos.");

}); // Fin DOMContentLoaded