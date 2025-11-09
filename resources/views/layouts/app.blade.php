<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        {{-- Añadimos Inter para una sensación más moderna y empresarial --}}
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Estilos personalizados si fueran necesarios, aunque preferimos Tailwind inline --}}
        <style>
            /* Clases para animar la aparición del modal */
            .modal-active {
                display: flex !important; /* Muestra el overlay */
            }
            .panel-active {
                transform: translateX(0) !important; /* Desliza el carrito a la vista */
            }
        </style>
    </head>
    {{-- CAMBIO 1: Usamos 'Inter' como fuente base --}}
    <body class="font-[Inter] antialiased bg-gray-50">
        <div class="min-h-screen bg-gray-50">
            @include('layouts.navigation')

            <!-- Page Heading (Encabezado de Página) -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-40">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>

            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- === INICIO HTML DEL CARRITO (SIDE PANEL) === --}}
        {{-- CAMBIO 2: Mejorar las clases de transición y z-index --}}
        <div id="cart-overlay" 
             class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-sm z-[100] hidden opacity-0 transition-opacity duration-500">
        </div>
        
        <div id="cart-panel" 
             class="fixed top-0 right-0 h-full w-full max-w-sm bg-white z-[101] transform translate-x-full transition-transform duration-500 shadow-2xl flex flex-col">
            {{-- El contenido se renderizará aquí con JS --}}
            <div class="flex items-center justify-center h-full">
                <p class="text-gray-500">Cargando carrito...</p>
            </div>
        </div>
        
        {{-- === FIN HTML DEL CARRITO === --}}


        {{-- === INICIO HTML DEL CHECKOUT MODAL === --}}
        <div id="checkout-overlay" 
             class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-md z-[110] hidden items-center justify-center p-4">
            
            <div id="checkout-panel" 
                 class="bg-white rounded-2xl w-full max-w-4xl transform transition-all duration-300 scale-95 opacity-0 shadow-3xl max-h-[95vh] overflow-hidden border border-gray-100 flex flex-col">
                
                {{-- Encabezado del Modal --}}
                <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-white sticky top-0 z-10">
                    <div>
                     {{-- CAMBIO 3.1: Fuente y color para el título del modal --}}
                        <h2 class="text-2xl font-bold text-gray-900">Finalizar Compra</h2>
                        <p class="text-gray-500 mt-1 text-sm">Completa tu información para recibir tus prendas</p>
                    </div>
                    {{-- CAMBIO 3.2: Botón de cerrar más limpio --}}
                    <button id="close-checkout-button" class="p-2 text-gray-400 rounded-full hover:bg-gray-100 hover:text-gray-600 transition duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- Contenido del Modal (Scrollable) --}}
                <div class="p-6 overflow-y-auto flex-grow">
                    <form id="checkout-form" class="space-y-8">
                        @csrf
                        {{-- CAMBIO 3.3: Ajustamos la grilla para mejor responsividad en móvil (md: en lugar de lg: para tablet) --}}
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                            
                            {{-- Columna Izquierda: Formulario de Envío (Ocupa 3/5 en escritorio) --}}
                            <div class="space-y-6 bg-white md:col-span-3">
                                <h3 class="font-bold text-gray-700 text-xl border-b pb-2 mb-4">Detalles de Envío</h3>
                                <div class="space-y-4">
                                    {{-- El contenido de x-input-label y x-text-input debe ser revisado individualmente, pero las clases de contenedores son correctas aquí. --}}
                                    <div>
                                        <x-input-label for="direccion" value="Dirección Completa" class="mb-1 text-sm !font-semibold !text-gray-700" />
                                        <x-text-input type="text" name="direccion" id="direccion" class="w-full text-sm rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Calle, número, colonia" required />
                                    </div>
                                    
                                    {{-- CAMBIO 3.4: Hacemos los inputs de ciudad/cp más responsivos (2 columnas en móvil) --}}
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <x-input-label for="ciudad" value="Ciudad" class="mb-1 text-sm !font-semibold !text-gray-700" />
                                            <x-text-input type="text" name="ciudad" id="ciudad" class="w-full text-sm rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="Tu ciudad" required />
                                        </div>
                                        <div>
                                            <x-input-label for="cp" value="Código Postal" class="mb-1 text-sm !font-semibold !text-gray-700" />
                                            <x-text-input type="text" name="cp" id="cp" class="w-full text-sm rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="CP" required />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="telefono" value="Teléfono de Contacto" class="mb-1 text-sm !font-semibold !text-gray-700" />
                                        <x-text-input type="tel" name="telefono" id="telefono" class="w-full text-sm rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" placeholder="+51 987 654 321" required />
                                    </div>
                                </div>
                            </div>

                            {{-- Columna Derecha: Resumen y Confirmar (Ocupa 2/5 en escritorio) --}}
                            <div class="space-y-6 md:col-span-2">
                                {{-- CAMBIO 3.5: Usamos un color de fondo más cálido para el resumen y una sombra más profunda --}}
                                <div class="bg-green-50 p-6 rounded-xl shadow-inner border border-green-100">
                                    <h3 class="font-bold text-green-700 text-xl mb-4">Resumen del Pedido</h3>
                                    <div id="checkout-summary-items" class="space-y-3 mb-4 max-h-40 overflow-y-auto border-b border-green-200 pb-3">
                                        {{-- Los items se cargarán aquí con JS --}}
                                        <p class="text-sm text-gray-500 text-center py-4">Cargando...</p>
                                    </div>
                                    <div class="space-y-2 border-t border-green-200 pt-3">
                                        {{-- Ajustamos colores para la jerarquía visual --}}
                                        <div class="flex justify-between items-center text-sm"><span class="text-green-800">Subtotal:</span><span id="checkout-summary-subtotal" class="font-semibold text-green-700">$0.00</span></div>
                                        <div class="flex justify-between items-center text-sm"><span class="text-green-800">Envío:</span><span id="checkout-summary-shipping" class="font-semibold text-green-700">$10.00</span></div>
                                        <div class="flex justify-between items-center text-xl font-bold border-t border-green-200 pt-2 mt-2"><span class="text-green-900">Total:</span><span id="checkout-summary-total" class="text-green-900 text-2xl">$0.00</span></div>
                                    </div>
                                </div>
                                {{-- CAMBIO 3.6: Botón principal con enfoque y sombra más fuerte --}}
                                <x-primary-button type="submit" class="w-full justify-center !py-3 !text-lg !font-bold 
                                    bg-green-600 hover:bg-green-700 focus:ring-green-500 shadow-lg hover:shadow-xl transition duration-150">
                                    Confirmar Pedido
                                </x-primary-button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
            

        </div>


        {{-- === FIN HTML DEL CHECKOUT MODAL === --}}
        
        <x-footer />       
    </body>
</html>