import './bootstrap'; // Archivo principal de JavaScript
import './carrito.js';  // Lógica del carrito de compras
import './checkout.js'; // Lógica de checkout
import './favoritos.js'; // Lógica de favoritos
import './soporte.js'; // Lógica de soporte
import './filtros.js'; // Lógica de filtros de productos

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
