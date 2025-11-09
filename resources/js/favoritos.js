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
 * Elimina un producto del DOM con animación cuando se quita de favoritos
 */
function removeProductFromDOM(productId) {
    const productElement = document.querySelector(`.group[data-id="${productId}"]`);
    if (productElement) {
        // Animación de desvanecimiento
        productElement.style.transition = 'all 0.3s ease';
        productElement.style.opacity = '0';
        productElement.style.transform = 'scale(0.8)';
        
        setTimeout(() => {
            productElement.remove();
            updateFavoritesCount();
            checkEmptyState();
        }, 300);
    }
}

/**
 * Actualiza el contador de favoritos en la página
 */
function updateFavoritesCount() {
    const remainingProducts = document.querySelectorAll('#favorites-grid .group[data-id]').length;
    const countElement = document.querySelector('.bg-gradient-to-r.from-red-500.to-pink-500 span');
    
    if (countElement) {
        countElement.textContent = remainingProducts;
    }
    
    // Actualizar el texto del contador
    const textElement = document.querySelector('.bg-gradient-to-r.from-red-50.to-pink-50 p.font-bold');
    if (textElement) {
        textElement.textContent = `${remainingProducts} ${remainingProducts === 1 ? 'artículo guardado' : 'artículos guardados'}`;
    }
}

/**
 * Verifica si está vacío y muestra el estado correspondiente
 */
function checkEmptyState() {
    const productsGrid = document.getElementById('favorites-grid');
    const remainingProducts = document.querySelectorAll('#favorites-grid .group[data-id]').length;
    
    if (remainingProducts === 0 && productsGrid) {
        // Usar el mismo HTML que ya tienes en tu blade.php
        productsGrid.innerHTML = `
            <div class="text-center bg-gradient-to-br from-red-50 to-pink-50 border-2 border-dashed border-red-200 rounded-2xl py-16 sm:py-20 px-6 mt-8 shadow-inner col-span-full">
                <div class="relative inline-block mb-8">
                    <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-r from-red-200 to-pink-200 rounded-full flex items-center justify-center mx-auto shadow-lg">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 text-red-300 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-3xl sm:text-4xl">💔</span>
                    </div>
                </div>
                
                <h3 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-4">Tu lista de favoritos está vacía</h3>
                <p class="text-gray-600 max-w-md mx-auto leading-relaxed text-base sm:text-lg mb-8">
                    Guarda tus prendas favoritas haciendo clic en el corazón para encontrarlas fácilmente más tarde. 
                    ¡Descubre piezas únicas con historia!
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/" 
                       class="inline-flex items-center px-6 sm:px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 text-sm sm:text-base">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Descubrir Colección
                    </a>
                    
                    <a href="/coleccion" 
                       class="inline-flex items-center px-6 sm:px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-bold rounded-2xl border border-gray-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 text-sm sm:text-base">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Ver Todo el Catálogo
                    </a>
                </div>
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                    <div class="text-center p-4">
                        <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                            <div class="relative">
                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                                <div class="absolute -top-1 -right-1 w-4 h-4 bg-white rounded-full border border-red-300"></div>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        <p class="font-semibold text-gray-700">Haz clic en el corazón</p>
                        <p class="text-sm text-gray-600 mt-1">En cualquier producto para guardarlo</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                            <div class="relative">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <div class="absolute -bottom-1 -right-1 w-5 h-3 bg-amber-500 rounded-sm"></div>
                            </div>
                        </div>
                        <p class="font-semibold text-gray-700">Acceso rápido</p>
                        <p class="text-sm text-gray-600 mt-1">Encuentra tus favoritos fácilmente</p>
                    </div>
                    
                    <div class="text-center p-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                            <div class="relative">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">+</span>
                                </div>
                            </div>
                        </div>
                        <p class="font-semibold text-gray-700">Compra más tarde</p>
                        <p class="text-sm text-gray-600 mt-1">No pierdas tus artículos preferidos</p>
                    </div>
                </div>
            </div>
            
        `;
    }
}

/**
 * Actualiza la apariencia de TODOS los botones de corazón en la página.
 */
function updateHeartIcons() {
    console.log("Actualizando iconos de corazón. Favoritos actuales:", favoriteProductIds);
    document.querySelectorAll('.favorite-btn').forEach(button => {
        const productId = parseInt(button.dataset.id, 10);
        if (favoriteProductIds.has(productId)) {
            button.innerHTML = heartIconFilled;
            button.classList.add('text-red-500');
        } else {
            button.innerHTML = heartIconEmpty;
            button.classList.remove('text-red-500');
        }
    });
}

/**
 * Llama al backend para añadir/quitar un favorito y actualiza la UI.
 */
async function toggleFavorite(productId) {
    if (!csrfToken) {
        console.warn("No hay token CSRF, redirigiendo a login.");
        alert("Debes iniciar sesión para guardar favoritos.");
        window.location.href = '/login';
        return;
    }

    console.log(`Intentando toggle favorito para producto ID: ${productId}`);
    try {
        const response = await fetch(`/favoritos/toggle/${productId}`, {
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
                
                // SOLUCIÓN: Si estamos en la página de favoritos, eliminar el producto del DOM
                if (window.location.pathname.includes('favoritos')) {
                    removeProductFromDOM(productId);
                }
            }
            
            updateHeartIcons();
            
        } else {
             console.error("Error en la respuesta del servidor al hacer toggle:", result);
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
    if (initialFavoritesLoaded || !csrfToken) {
        if (!csrfToken) updateHeartIcons();
        return;
    }

    console.log("Obteniendo favoritos iniciales...");
    try {
        const response = await fetch('/favoritos/ids', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if (!response.ok) {
            if (response.status === 401 || response.status === 403) {
                 console.log("Usuario no autenticado al obtener IDs de favoritos.");
                 initialFavoritesLoaded = true;
                 updateHeartIcons();
                 return;
            }
            throw new Error(`Error ${response.status}`);
        }
        const result = await response.json();
        if (result.status === 'success' && Array.isArray(result.favoritoIds)) {
            favoriteProductIds = new Set(result.favoritoIds);
            initialFavoritesLoaded = true;
            console.log("Favoritos iniciales cargados:", favoriteProductIds);
            updateHeartIcons();
        } else {
             console.error("Respuesta inesperada al obtener IDs de favoritos:", result);
             initialFavoritesLoaded = true;
             updateHeartIcons();
        }
    } catch (error) {
        console.error("Error de red al obtener IDs de favoritos:", error);
        initialFavoritesLoaded = true;
        updateHeartIcons();
    }
}

// --- Event Listener Principal ---
document.addEventListener('DOMContentLoaded', () => {
    csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    console.log("DOM cargado para Favoritos. CSRF Token:", csrfToken);

    document.body.addEventListener('click', (event) => {
        const favoriteButton = event.target.closest('.favorite-btn');
        
        if (favoriteButton) {
            console.log("Clic detectado en botón de favorito.");
            event.preventDefault();
            const productId = parseInt(favoriteButton.dataset.id, 10);
            if (productId) {
                toggleFavorite(productId);
            } else {
                console.error("No se pudo obtener el product ID del botón:", favoriteButton);
            }
        }
    });

    fetchInitialFavorites();
});

// Funciones globales
window.updateHeartIcons = updateHeartIcons;