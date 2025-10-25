// resources/js/favoritos.js
console.log("Favoritos.js cargado!");

// Almacenará los IDs de los productos favoritos del usuario
let favoriteProductIds = new Set();
// Variable para saber si ya se cargaron los favoritos iniciales
let initialFavoritesLoaded = false;
// Token CSRF (lo obtendremos cuando el DOM cargue)
let csrfToken;

// --- Iconos SVG para los corazones ---
const heartIconEmpty = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>`;
const heartIconFilled = `<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>`;

/**
 * Actualiza la apariencia de TODOS los botones de corazón en la página.
 * Reemplaza updateHeartIcons
 */
function updateHeartIcons() {
    console.log("Actualizando iconos de corazón. Favoritos actuales:", favoriteProductIds);
    document.querySelectorAll('.favorite-btn').forEach(button => {
        const productId = parseInt(button.dataset.id, 10);
        if (favoriteProductIds.has(productId)) {
            button.innerHTML = heartIconFilled;
            button.classList.add('text-red-500'); // Color rojo cuando es favorito
        } else {
            button.innerHTML = heartIconEmpty;
            button.classList.remove('text-red-500'); // Quita el color si no es favorito
        }
    });
}

/**
 * Llama al backend para añadir/quitar un favorito y actualiza la UI.
 * Reemplaza toggleFavorite
 */
async function toggleFavorite(productId) {
    // Si no tenemos token, probablemente no está logueado
    if (!csrfToken) {
        console.warn("No hay token CSRF, redirigiendo a login.");
        alert("Debes iniciar sesión para guardar favoritos.");
        window.location.href = '/login';
        return;
    }

    console.log(`Intentando toggle favorito para producto ID: ${productId}`);
    try {
        const response = await fetch(`/favoritos/toggle/${productId}`, { // Llama a la ruta POST
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });

        const result = await response.json();

        if (response.ok && result.status === 'success') {
            console.log(`Producto ${productId} ${result.action}`);
            // Actualiza el Set local
            if (result.action === 'added') {
                favoriteProductIds.add(productId);
            } else {
                favoriteProductIds.delete(productId);
            }
            updateHeartIcons(); // Actualiza todos los botones
        } else {
             console.error("Error en la respuesta del servidor al hacer toggle:", result);
             // Redirigir si el error es de autenticación
             if (response.status === 401 || response.status === 403) {
                 alert("Debes iniciar sesión para guardar favoritos.");
                 window.location.href = '/login';
             } else {
                 alert("Error al actualizar favoritos.");
             }
        }
    } catch (error) {
        console.error("Error de red al hacer toggle de favorito:", error);
        alert("Error de conexión al actualizar favoritos.");
    }
}

/**
 * Obtiene los IDs de los favoritos del usuario al cargar la página.
 */
async function fetchInitialFavorites() {
    // Si ya cargaron o no hay token (no logueado), no hacer nada
    if (initialFavoritesLoaded || !csrfToken) {
        // Asegurarse de que los iconos se muestren vacíos si no está logueado
        if (!csrfToken) updateHeartIcons();
        return;
    }

    console.log("Obteniendo favoritos iniciales...");
    try {
        const response = await fetch('/favoritos/ids', { // Llama a la ruta GET
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!response.ok) {
            // No tratar errores 401/403 como críticos aquí, solo significa que no está logueado
            if (response.status === 401 || response.status === 403) {
                 console.log("Usuario no autenticado al obtener IDs de favoritos.");
                 initialFavoritesLoaded = true; // Marcamos como cargado (vacío)
                 updateHeartIcons(); // Asegura que los iconos estén vacíos
                 return;
            }
            throw new Error(`Error ${response.status}`);
        }
        const result = await response.json();
        if (result.status === 'success' && Array.isArray(result.favoritoIds)) {
            favoriteProductIds = new Set(result.favoritoIds);
            initialFavoritesLoaded = true;
            console.log("Favoritos iniciales cargados:", favoriteProductIds);
            updateHeartIcons(); // Actualiza los iconos ahora que tenemos los datos
        } else {
             console.error("Respuesta inesperada al obtener IDs de favoritos:", result);
             initialFavoritesLoaded = true; // Marcar como cargado para no reintentar
             updateHeartIcons(); // Actualiza con Set vacío
        }
    } catch (error) {
        console.error("Error de red al obtener IDs de favoritos:", error);
        initialFavoritesLoaded = true; // Marcar como cargado para no reintentar
        updateHeartIcons(); // Actualiza con Set vacío
    }
}

// --- Event Listener Principal (Delegación de eventos) ---
document.addEventListener('DOMContentLoaded', () => {
    // Obtener token CSRF
    csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    console.log("DOM cargado para Favoritos. CSRF Token:", csrfToken);

    // Listener de clic en cualquier parte del body
    document.body.addEventListener('click', (event) => {
        // Busca si el clic ocurrió dentro de un botón con la clase 'favorite-btn'
        const favoriteButton = event.target.closest('.favorite-btn');
        
        if (favoriteButton) {
            console.log("Clic detectado en botón de favorito.");
            event.preventDefault(); // Prevenir cualquier acción por defecto del botón
            const productId = parseInt(favoriteButton.dataset.id, 10);
            if (productId) {
                toggleFavorite(productId);
            } else {
                console.error("No se pudo obtener el product ID del botón:", favoriteButton);
            }
        }
    });

    // Cargar los favoritos iniciales
    fetchInitialFavorites();
});

// Hacemos la función global por si se necesita recargar dinámicamente
// (similar a como lo hacías en tu original)
window.updateHeartIcons = updateHeartIcons;