<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GreenCloset - Colección</title> {{-- Título actualizado --}}

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- Scripts y CSS (Vite) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Token CSRF para AJAX --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Configuración de Tailwind (para que funcionen las clases 'brand-') --}}
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'sans': ['Figtree', 'Inter', 'sans-serif'],
                            'serif': ['Playfair Display', 'serif']
                        },
                        colors: {
                            'brand': {
                                '50': '#f4f6f3', '100': '#e5e9e2', '200': '#cbd3c7', '300': '#94a68e',
                                '400': '#7c9176', '500': '#5c7356', '600': '#455a41', '700': '#374834',
                                '800': '#2d3a2b', '900': '#253024', '950': '#141a14'
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-brand-50 text-brand-800 flex flex-col min-h-screen">
        <div class="flex-grow"> {{-- Contenedor para empujar footer hacia abajo --}}

            {{-- Incluimos la barra de navegación --}}
            @include('layouts.navigation')

            <main>
                {{-- Contenido de la Colección --}}
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        {{-- Título de la sección --}}
                        <div class="text-center mb-12">
                            <p class="text-sm uppercase tracking-wider text-brand-500">Moda Circular</p>
                            <h1 class="text-4xl md:text-5xl font-bold text-brand-800 font-serif mt-2">Nuestra Colección</h1>
                            <p class="text-brand-600 mt-4 max-w-2xl mx-auto">Descubre prendas únicas con historia.</p>
                        </div>

                        {{-- Layout FLEX con Sidebar y Grid --}}
                        <div class="flex flex-col lg:flex-row gap-8 mt-8">

                            {{-- Sidebar de Filtros --}}
                            <aside class="w-full lg:w-72 flex-shrink-0">
                                <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm sticky top-24">
                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-brand-700 mb-2">Buscar prendas</label>
                                        <input type="text" id="search-input" name="busqueda" placeholder="Buscar..."
                                               class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-brand-700 mb-2">Categoría</label>
                                        <select name="categoria" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                            <option value="">Todas</option>
                                            @foreach ($categorias ?? [] as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-brand-700 mb-2">Precio</label>
                                        <div class="grid grid-cols-2 gap-3">
                                            <input type="number" name="precio_min" placeholder="Mín $"
                                                   class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent" min="0" step="0.01">
                                            <input type="number" name="precio_max" placeholder="Máx $"
                                                   class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent" min="0" step="0.01">
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-brand-700 mb-2">Talla</label>
                                        <select name="talla" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                            <option value="">Todas</option>
                                            <option value="XS">XS</option> <option value="S">S</option> <option value="M">M</option>
                                            <option value="L">L</option> <option value="XL">XL</option> <option value="Única">Única</option>
                                        </select>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-brand-700 mb-2">Estado</label>
                                        <select name="estado" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                            <option value="">Todos</option>
                                            <option value="Nuevo">Nuevo</option> <option value="Como nuevo">Como nuevo</option>
                                            <option value="Buen estado">Buen estado</option> <option value="Usado">Usado</option>
                                        </select>
                                    </div>

                                    <div class="mb-6">
                                        <label class="block text-sm font-semibold text-brand-700 mb-2">Ordenar por</label>
                                        <select name="orden" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                            <option value="fecha_desc">Más recientes</option>
                                            <option value="precio_asc">Precio: menor a mayor</option>
                                            <option value="precio_desc">Precio: mayor a menor</option>
                                            <option value="nombre_asc">Nombre A-Z</option>
                                        </select>
                                    </div>

                                    <button id="clear-filters-button" class="w-full bg-brand-200 text-brand-700 py-2 px-4 rounded-lg font-semibold text-sm hover:bg-brand-300 transition-colors">
                                        Limpiar Filtros
                                    </button>
                                </div>
                            </aside>

                            {{-- Grid de Productos (Contenedor principal) --}}
                            <div class="flex-1">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 text-gray-900">
                                        {{-- Contenedor para la rejilla (para AJAX) --}}
                                        <div id="product-grid-container">
                                             {{-- Incluimos la vista parcial del grid --}}
                                             {{-- La variable $productos viene del ProductoController@index --}}
                                            @include('productos.partials.grid', ['productos' => $productos])
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> {{-- Fin Layout Flex --}}
                    </div>
                </div>
            </main>
        </div> {{-- Fin flex-grow --}}

        {{-- Incluimos el Footer --}}
        <x-footer />

        {{-- HTML Oculto para Carrito --}}
        <div id="cart-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-[100] hidden opacity-0 transition-opacity duration-300"></div>
        <div id="cart-panel"
             class="fixed top-0 right-0 h-full w-full max-w-md bg-white z-[101] transform translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
             <div class="flex items-center justify-center h-full"><p class="text-gray-500">Cargando carrito...</p></div>
        </div>

        {{-- HTML Oculto para Checkout Modal --}}
        <div id="checkout-overlay"
             class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-md z-[110] hidden items-center justify-center p-4">
            <div id="checkout-panel"
                 class="bg-white rounded-lg w-full max-w-4xl transform transition-all duration-300 scale-95 opacity-0 shadow-xl max-h-[90vh] overflow-hidden border border-gray-200 flex flex-col">
                {{-- Encabezado --}}
                <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-gray-50">
                    <div><h2 class="text-2xl font-semibold font-serif text-gray-800">Finalizar Compra</h2><p class="text-gray-600 mt-1 text-sm">Completa tu información</p></div>
                    <button id="close-checkout-button" class="p-2 text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                 {{-- Contenido Scrollable --}}
                <div class="p-6 overflow-y-auto flex-grow">
                     <form id="checkout-form" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                             {{-- Columna Izquierda: Formulario Envío --}}
                            <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                                 <h3 class="font-semibold text-gray-700 text-lg mb-4">Información de Envío</h3>
                                <div class="space-y-4">
                                    <div><x-input-label for="direccion_modal_wc" value="Dirección Completa" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="text" name="direccion" id="direccion_modal_wc" class="w-full text-sm" placeholder="Calle, número, colonia" required /></div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div><x-input-label for="ciudad_modal_wc" value="Ciudad" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="text" name="ciudad" id="ciudad_modal_wc" class="w-full text-sm" placeholder="Tu ciudad" required /></div>
                                        <div><x-input-label for="cp_modal_wc" value="Código Postal" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="text" name="cp" id="cp_modal_wc" class="w-full text-sm" placeholder="CP" required /></div>
                                    </div>
                                     <div><x-input-label for="telefono_modal_wc" value="Teléfono" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="tel" name="telefono" id="telefono_modal_wc" class="w-full text-sm" placeholder="+XX XXX XXX XXX" required /></div>
                                </div>
                            </div>
                            {{-- Columna Derecha: Resumen --}}
                             <div class="space-y-6">
                                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                    <h3 class="font-semibold text-gray-700 text-lg mb-4">Resumen</h3>
                                     <div id="checkout-summary-items" class="space-y-2 mb-4 max-h-40 overflow-y-auto border-b border-gray-200 pb-3"><p class="text-sm text-gray-500 text-center py-4">Cargando...</p></div>
                                    <div class="space-y-1 border-t border-gray-200 pt-3 text-sm">
                                        <div class="flex justify-between"><span class="text-gray-600">Subtotal:</span><span id="checkout-summary-subtotal" class="font-semibold text-gray-700">$0.00</span></div>
                                        <div class="flex justify-between"><span class="text-gray-600">Envío:</span><span id="checkout-summary-shipping" class="font-semibold text-gray-700">$10.00</span></div>
                                        <div class="flex justify-between text-base font-bold border-t border-gray-200 pt-2 mt-2"><span class="text-gray-800">Total:</span><span id="checkout-summary-total" class="text-brand-700 text-lg">$0.00</span></div>
                                    </div>
                                </div>
                                <x-primary-button type="submit" class="w-full justify-center !py-3 !text-base !font-bold">Confirmar Pedido</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>