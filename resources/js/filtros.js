// resources/js/filtros.js
console.log("Filtros.js cargado!");

class ProductFilters {
    constructor() {
        this.filters = {}; // Almacenará los filtros activos
        this.filterInputs = document.querySelectorAll('.filter-input');
        this.searchInput = document.getElementById('search-input');
        this.clearButton = document.getElementById('clear-filters-button');
        this.productGridContainer = document.getElementById('product-grid-container');
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        // Determina la URL base (ej. /coleccion o /ofertas)
        this.baseUrl = window.location.pathname;

        this.init();
    }

    init() {
        if (!this.productGridContainer) {
            console.warn("No se encontró el contenedor #product-grid-container. Los filtros no funcionarán.");
            return;
        }
        this.bindEvents();
        // No necesitamos cargar productos iniciales aquí, Laravel ya lo hizo.
        // this.applyFilters(); // Comentado
        console.log("Filtros inicializados.");
    }

    bindEvents() {
        // Inputs de select y número
        this.filterInputs.forEach(input => {
            input.addEventListener('change', this.debounce(() => {
                this.updateFilters();
                this.applyFilters();
            }, 300)); // Debounce para no sobrecargar
        });

        // Input de búsqueda
        if (this.searchInput) {
            this.searchInput.addEventListener('input', this.debounce(() => {
                this.updateFilters();
                this.applyFilters();
            }, 500)); // Un poco más de debounce para búsqueda
        }

        // Botón Limpiar Filtros
        if (this.clearButton) {
            this.clearButton.addEventListener('click', () => {
                this.clearFilters();
            });
        }
    }

    // Actualiza el objeto this.filters con los valores actuales del formulario
    updateFilters() {
        this.filters = {}; // Reinicia los filtros
        this.filterInputs.forEach(input => {
            if (input.value) {
                this.filters[input.name] = input.value;
            }
        });
        if (this.searchInput && this.searchInput.value) {
            this.filters['busqueda'] = this.searchInput.value;
        }
        console.log("Filtros actualizados:", this.filters);
    }

    // Aplica los filtros enviando una petición AJAX al backend
    async applyFilters() {
        if (!this.productGridContainer) return;

        // Mostrar estado de carga (opcional pero recomendado)
        this.productGridContainer.innerHTML = `
            <div class="col-span-full text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-brand-500 mx-auto mb-4"></div>
                <p class="text-brand-600">Filtrando prendas...</p>
            </div>`;

        // Construir URL con parámetros de filtro
        const params = new URLSearchParams(this.filters);
        const url = `${this.baseUrl}?${params.toString()}`;
        console.log("Aplicando filtros con URL:", url);

        try {
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Accept': 'text/html', // Esperamos HTML (la vista parcial del grid)
                    'X-Requested-With': 'XMLHttpRequest' // Importante para que Laravel detecte AJAX
                    // No necesitamos CSRF token para GET
                }
            });

            if (!response.ok) {
                throw new Error(`Error ${response.status}: ${response.statusText}`);
            }

            // Reemplaza el contenido del grid con la respuesta HTML
            const htmlResult = await response.text();
            this.productGridContainer.innerHTML = htmlResult;

            // IMPORTANTE: Después de reemplazar el HTML, debemos
            // re-inicializar los listeners de carrito y favoritos si es necesario.
            // O idealmente, usar delegación de eventos.
            // Por ahora, asumimos que carrito.js y favoritos.js usan delegación
            // o se re-ejecutan de alguna manera. Si no, los botones dejarán de funcionar.
            // Si window.updateHeartIcons existe, llámalo.
            if (typeof window.updateHeartIcons === 'function') {
                window.updateHeartIcons();
            }


        } catch (error) {
            console.error('Error al aplicar filtros:', error);
            this.productGridContainer.innerHTML = `
                <div class="col-span-full text-center py-12 text-red-600">
                    <p>Error al cargar los productos. Intenta nuevamente.</p>
                </div>`;
        }
    }

    // Limpia todos los filtros y recarga
    clearFilters() {
        this.filters = {};
        this.filterInputs.forEach(input => { input.value = ''; });
        if (this.searchInput) this.searchInput.value = '';
        console.log("Filtros limpiados.");
        this.applyFilters(); // Aplica los filtros vacíos para recargar
    }

    // Función Debounce (evita llamadas excesivas)
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Inicializar el sistema cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
    // Solo inicializa si estamos en /coleccion o /ofertas
    if (window.location.pathname === '/coleccion' || window.location.pathname === '/ofertas') {
        new ProductFilters();
    }
});