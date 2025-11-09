// resources/js/carrito.js
console.log("¡Carrito.js cargado!"); // Log inicial

// Función para alertas bonitas
function showCustomAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `fixed top-4 right-4 z-50 max-w-sm w-full p-4 rounded-lg shadow-lg border-l-4 transform transition-all duration-300 ${
        type === 'success' 
            ? 'bg-green-50 border-green-500 text-green-700' 
            : 'bg-red-50 border-red-500 text-red-700'
    }`;
    
    alertDiv.innerHTML = `
        <div class="flex items-center">
            <span class="text-lg mr-3">${type === 'success' ? '✅' : '⚠️'}</span>
            <div class="flex-1">
                <p class="font-medium">${type === 'success' ? '¡Éxito!' : 'Error'}</p>
                <p class="text-sm mt-1">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-500 hover:text-gray-700">
                ×
            </button>
        </div>
    `;
    
    document.body.appendChild(alertDiv);
    
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 4000);
}

document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM cargado, iniciando carrito..."); // Log después de cargar el DOM

    // Buscamos el token CSRF y los elementos del panel
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const cartOverlay = document.getElementById('cart-overlay');
    const cartPanel = document.getElementById('cart-panel');
    const openCartButton = document.getElementById('open-cart-button');
    const cartCountIndicator = document.getElementById('cart-count-indicator');
    let cartItems = []; // Almacenará los items del carrito

    // Log para verificar si el botón de abrir carrito fue encontrado
    console.log("Botón para abrir carrito encontrado:", openCartButton);


    
    // --- Funciones para abrir/cerrar el panel ---
    function openSideCart() {
        // Log para verificar si se llama a la función
        console.log("Intentando abrir el panel del carrito...");
        if (!cartOverlay || !cartPanel) {
            console.error("No se encontraron los elementos cartOverlay o cartPanel."); // Log si faltan elementos
            return;
        }
        cartOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Evita scroll del fondo
        requestAnimationFrame(() => {
            cartOverlay.classList.remove('opacity-0');
            cartPanel.classList.remove('translate-x-full');
        });
        fetchCartItems(); // Actualiza el contenido al abrir
    }

    function closeSideCart() {
        if (!cartOverlay || !cartPanel) return;
        cartOverlay.classList.add('opacity-0');
        cartPanel.classList.add('translate-x-full');
        setTimeout(() => {
            cartOverlay.classList.add('hidden');
            document.body.style.overflow = ''; // Restaura scroll
        }, 300); // Duración de la animación de Tailwind
    }

    // --- Función para obtener los items del servidor ---
    async function fetchCartItems() {
        try {
            const response = await fetch('/carrito', { // Llama a la ruta GET /carrito
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            if (!response.ok) {
                 if(response.status === 401 || response.status === 403) {
                     console.warn("Usuario no autenticado al intentar obtener carrito.");
                     renderCart([]); // Muestra carrito vacío si no está logueado
                     updateCartCount(0);
                     return; // No continuar si no está logueado
                 }
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }
            const result = await response.json();
            if (result.status === 'success') {
                cartItems = result.carrito;
                renderCart(cartItems);
                updateCartCount(cartItems.length);
            } else {
                console.error("Error al obtener carrito:", result.message);
                renderCart([]); // Muestra vacío en caso de error
                updateCartCount(0);
            }
        } catch (error) {
            console.error("Error de red al obtener carrito:", error);
            renderCart([]); // Muestra vacío en caso de error
             updateCartCount(0);
        }
    }

    // --- Función para renderizar el HTML del carrito ---
    function renderCart(items) {
        if (!cartPanel) return;
        let subtotal = 0;
        let itemsHTML = '';

        if (!items || items.length === 0) {
            itemsHTML = `
                <div class="text-center py-12 px-4 flex-grow flex flex-col justify-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Tu carrito está vacío</h3>
                </div>`;
        } else {
            items.forEach(item => {
                // Usa precio_final que ya viene calculado desde la migración/modelo si existe, sino calcula
                const price = parseFloat(item.pivot?.precio_unitario || item.precio_final || item.precio_oferta || item.precio);
                subtotal += price * (item.pivot?.cantidad || 1); // Multiplica por cantidad si existe
                itemsHTML += `
                    <div class="flex gap-4 p-4 border-b border-gray-100 last:border-b-0">
                        <img src="${escapeHtml(item.imagen_url)}" alt="${escapeHtml(item.nombre)}" class="w-16 h-20 object-cover rounded border flex-shrink-0">
                        <div class="flex-grow flex flex-col justify-between min-w-0">
                            <div>
                                <h3 class="font-semibold text-gray-800 text-sm truncate pr-2">${escapeHtml(item.nombre)}</h3>
                                <p class="text-xs text-gray-500 mt-1">Talla: ${escapeHtml(item.talla)} | ${escapeHtml(item.estado)}</p>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <span class="font-bold text-gray-700">$${price.toFixed(2)}</span>
                                <button class="remove-from-cart-btn text-xs text-red-500 hover:text-red-700 font-semibold transition-colors" data-id="${item.id}">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>`;
            });
        }
        cartPanel.innerHTML = `
            <div class="flex items-center justify-between p-4 border-b border-gray-200 flex-shrink-0">
                <h2 class="text-lg font-semibold text-gray-800">Mi Carrito</h2>
                <button id="close-cart-button" class="p-2 text-gray-500 hover:text-gray-700">&times;</button>
            </div>
            <div class="flex-grow p-4 overflow-y-auto bg-gray-50">
                ${itemsHTML}
            </div>
            ${ (items && items.length > 0) ? `
            <div class="p-4 border-t border-gray-200 bg-white flex-shrink-0">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-md font-semibold text-gray-700">Subtotal:</span>
                    <span class="text-xl font-bold text-gray-800">$${subtotal.toFixed(2)}</span>
                </div>
                <button id="go-to-checkout-from-cart" class="w-full text-center bg-brand-500 text-white py-3 rounded-md font-bold hover:bg-brand-600 transition">
                    Finalizar Compra
                </button>
            </div>
            ` : '' }
        `;
    }

     // --- Función para actualizar el contador ---
     function updateCartCount(count) {
         if (cartCountIndicator) {
             cartCountIndicator.textContent = count;
             cartCountIndicator.classList.toggle('hidden', count === 0);
         }
     }

    // --- Función para eliminar un item ---
    async function removeFromCart(productId) {
         console.log(`Intentando eliminar producto ID: ${productId}`);
         try {
             const response = await fetch(`/carrito/remove/${productId}`, {
                 method: 'DELETE',
                 headers: {
                     'Accept': 'application/json',
                     'X-CSRF-TOKEN': csrfToken
                 }
             });
             const result = await response.json();
             if (response.ok && result.status === 'success') {
                 console.log(result.message);
                 fetchCartItems(); // Recarga el carrito para reflejar el cambio
             } else {
                 console.error("Error al eliminar del carrito:", result.message);
                 alert("Error al eliminar el producto del carrito.");
             }
         } catch (error) {
             console.error("Error de red al eliminar:", error);
             alert("Error de conexión al eliminar el producto.");
         }
     }

    // --- Lógica de Agregar al Carrito (Modificada para recargar) ---
    // Log para verificar cuántos botones se encontraron
    const buttons = document.querySelectorAll('.add-to-cart-btn');
    console.log(`Encontrados ${buttons.length} botones 'Agregar al carrito'.`);

    buttons.forEach(button => {
        button.addEventListener('click', async (event) => {
            console.log("¡Botón 'Agregar al carrito' clickeado!", event.target); // Log al hacer clic
            event.preventDefault();

            const productCard = button.closest('.group[data-id]');
            if (!productCard) {
                 console.error("No se encontró la tarjeta del producto (.group[data-id])"); // Log si no encuentra la tarjeta
                 return;
            }

            const productId = productCard.dataset.id;

            // --- Logs añadidos para depurar variables ---
            console.log("CSRF Token:", csrfToken);
            console.log("Product ID:", productId);
            // -------------------------------------------

            if (!productId || !csrfToken) {
                 console.error("Falta productId o csrfToken");
                  if (!csrfToken) {
                      alert('Debes iniciar sesión para agregar productos al carrito.');
                      window.location.href = '/login';
                  }
                 return;
             }

            try {
                console.log(`Intentando fetch a: /carrito/add/${productId}`); // Log antes del fetch
                const response = await fetch(`/carrito/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                });

                console.log("Respuesta recibida:", response.status, response.statusText); // Log después del fetch

                const result = await response.json();

                if (response.ok && result.status === 'success') {
                    // ¡Éxito!
                    showCustomAlert(result.message, 'success');
                    fetchCartItems();  // <--- RECARGA EL CARRITO DESPUÉS DE AÑADIR
                } else {
                     console.error("Error en la respuesta del servidor:", result);
                     if(response.status === 401 || response.status === 403) {
                         alert('Debes iniciar sesión para agregar productos al carrito.');
                         window.location.href = '/login';
                     } else {
                         alert('Error al agregar el producto al carrito.');
                     }
                }
            } catch (error) {
                console.error("Error durante el fetch:", error); // Log más específico para errores de fetch
                alert('Hubo un error de conexión. Inténtalo de nuevo.');
            }
        });
    });

    // --- Event Listeners para Abrir/Cerrar/Eliminar ---
    if (openCartButton) {
        // Log para confirmar que se añade el listener
        console.log("Añadiendo listener al botón de abrir carrito.");
        openCartButton.addEventListener('click', openSideCart);
    } else {
        // Log si no se encuentra el botón
        console.error("¡No se encontró el botón #open-cart-button para añadir el listener!");
    }

    // Cerrar al hacer clic fuera o en el botón de cerrar
    document.body.addEventListener('click', (event) => {
        if (event.target === cartOverlay || event.target.closest('#close-cart-button')) {
            closeSideCart();
        }
        // Listener para botones de eliminar DENTRO del panel
        const removeButton = event.target.closest('.remove-from-cart-btn');
        if (removeButton && cartPanel?.contains(removeButton)) { // Usamos optional chaining por si cartPanel no existe
            const productId = removeButton.dataset.id;
            if (productId) {
                removeFromCart(productId);
            }
        }
        // Listener para botón "Finalizar Compra" DENTRO del panel (opcional)
         // Listener para botón "Finalizar Compra" DENTRO del panel
        if (event.target.id === 'go-to-checkout-from-cart') {
            event.preventDefault(); // Buena práctica añadir esto
            // LLAMA A LA FUNCIÓN PARA ABRIR EL MODAL DE CHECKOUT
            if (typeof openCheckoutModal === 'function') { 
                openCheckoutModal(); 
            } else {
                console.error("La función openCheckoutModal no está definida globalmente.");
                alert("Error al abrir el checkout.");
            }
            // Ya no necesitamos cerrar el panel lateral aquí, openCheckoutModal lo hará si es necesario.
            // closeSideCart(); // <-- QUITA ESTA LÍNEA
        }
    });

     // --- Función auxiliar para escapar HTML ---
     function escapeHtml(unsafe) {
         if (typeof unsafe !== 'string') return "";
         return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
     }

    // --- Carga inicial del contador (si estás logueado) ---
     if (openCartButton) {
        fetchCartItems();
     } else {
         updateCartCount(0); // Asegura contador oculto para invitados
     }

}); // Fin del DOMContentLoaded
