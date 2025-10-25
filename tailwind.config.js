import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                // Añadimos tus fuentes del proyecto original
                serif: ['Playfair Display', 'serif']
            },
            // Añadimos tu paleta de colores
            colors: {
                'brand': {
                    '50': '#f4f6f3',
                    '100': '#e5e9e2',
                    '200': '#cbd3c7',
                    '300': '#94a68e',
                    '400': '#7c9176',
                    '500': '#5c7356',
                    '600': '#455a41',
                    '700': '#374834',
                    '800': '#2d3a2b',
                    '900': '#253024',
                    '950': '#141a14'
                }
            }
        },
    },

    plugins: [forms],
};
