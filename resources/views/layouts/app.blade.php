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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- === INICIO HTML DEL CARRITO === --}}
        <div id="cart-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-[100] hidden opacity-0 transition-opacity duration-300"></div>
        
        <div id="cart-panel" 
             class="fixed top-0 right-0 h-full w-full max-w-md bg-white z-[101] transform translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
             {{-- El contenido se renderizará aquí con JS --}}
             <div class="flex items-center justify-center h-full">
                 <p class="text-gray-500">Cargando carrito...</p>
             </div>
        </div>
        {{-- === FIN HTML DEL CARRITO === --}}


        {{-- === INICIO HTML DEL CHECKOUT MODAL === --}}
        {{-- Adaptado de footer.php --}}
        <div id="checkout-overlay" 
             class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-md z-[110] hidden items-center justify-center p-4">
            
            <div id="checkout-panel" 
                 class="bg-white rounded-lg w-full max-w-4xl transform transition-all duration-300 scale-95 opacity-0 shadow-xl max-h-[90vh] overflow-hidden border border-gray-200 flex flex-col">
                
                {{-- Encabezado del Modal --}}
                <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-gray-50">
                    <div>
                        <h2 class="text-2xl font-semibold font-serif text-gray-800">Finalizar Compra</h2>
                        <p class="text-gray-600 mt-1 text-sm">Completa tu información para recibir tus prendas</p>
                    </div>
                    <button id="close-checkout-button" class="p-2 text-gray-500 hover:text-gray-700">&times;</button>
                </div>

                {{-- Contenido del Modal (Scrollable) --}}
                <div class="p-6 overflow-y-auto flex-grow">
                    <form id="checkout-form" class="space-y-8">
                        @csrf {{-- ¡Importante para la seguridad de Laravel! --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            
                            {{-- Columna Izquierda: Formulario de Envío --}}
                            <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                                <h3 class="font-semibold text-gray-700 text-lg mb-4">Información de Envío</h3>
                                <div class="space-y-4">
                                    <div>
                                        <x-input-label for="direccion" value="Dirección Completa" class="mb-1 text-sm !font-semibold !text-gray-600" />
                                        <x-text-input type="text" name="direccion" id="direccion" class="w-full text-sm" placeholder="Calle, número, colonia" required />
                                        {{-- Podríamos añadir x-input-error aquí si quisiéramos mostrar errores de validación --}}
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <x-input-label for="ciudad" value="Ciudad" class="mb-1 text-sm !font-semibold !text-gray-600" />
                                            <x-text-input type="text" name="ciudad" id="ciudad" class="w-full text-sm" placeholder="Tu ciudad" required />
                                        </div>
                                        <div>
                                            <x-input-label for="cp" value="Código Postal" class="mb-1 text-sm !font-semibold !text-gray-600" />
                                            <x-text-input type="text" name="cp" id="cp" class="w-full text-sm" placeholder="CP" required />
                                        </div>
                                    </div>
                                    <div>
                                        <x-input-label for="telefono" value="Teléfono de Contacto" class="mb-1 text-sm !font-semibold !text-gray-600" />
                                        <x-text-input type="tel" name="telefono" id="telefono" class="w-full text-sm" placeholder="+51 987 654 321" required />
                                    </div>
                                </div>
                            </div>

                            {{-- Columna Derecha: Resumen y Confirmar --}}
                            <div class="space-y-6">
                                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                    <h3 class="font-semibold text-gray-700 text-lg mb-4">Resumen del Pedido</h3>
                                    <div id="checkout-summary-items" class="space-y-3 mb-4 max-h-40 overflow-y-auto border-b border-gray-200 pb-3">
                                        {{-- Los items se cargarán aquí con JS --}}
                                        <p class="text-sm text-gray-500 text-center py-4">Cargando...</p>
                                    </div>
                                    <div class="space-y-2 border-t border-gray-200 pt-3">
                                        <div class="flex justify-between items-center text-sm"><span class="text-gray-600">Subtotal:</span><span id="checkout-summary-subtotal" class="font-semibold text-gray-700">$0.00</span></div>
                                        <div class="flex justify-between items-center text-sm"><span class="text-gray-600">Envío:</span><span id="checkout-summary-shipping" class="font-semibold text-gray-700">$10.00</span></div>
                                        <div class="flex justify-between items-center text-lg font-bold border-t border-gray-200 pt-2 mt-2"><span class="text-gray-800">Total:</span><span id="checkout-summary-total" class="text-brand-700 text-xl">$0.00</span></div>
                                    </div>
                                </div>
                                <x-primary-button type="submit" class="w-full justify-center !py-3 !text-base !font-bold">
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
