<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <div class="p-3 sm:p-4 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl sm:rounded-2xl shadow-lg relative overflow-hidden group">
                {{-- Imagen de fondo --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-20 transition-transform duration-500 group-hover:scale-110" 
                     style="background-image: url('https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80')">
                </div>
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 opacity-90 group-hover:opacity-80 transition-opacity duration-300"></div>
                {{-- Icono moderno --}}
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 9h-2V5h2v6zm0 4h-2v-2h2v2z"/>
                </svg>
            </div>
            <h2 class="font-bold text-xl sm:text-2xl text-gray-800 leading-tight bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                {{ __('Soporte y Contacto') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-8 sm:py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 p-4 sm:p-6 lg:p-8">
                {{-- Header RESPONSIVE --}}
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex items-center space-x-2 bg-blue-100 px-4 py-2 sm:px-6 sm:py-3 rounded-full mb-4 sm:mb-6">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 9h-2V5h2v6zm0 4h-2v-2h2v2z"/>
                        </svg>
                        <span class="text-xs sm:text-sm font-bold text-blue-700 uppercase tracking-wider">SOPORTE Y CONTACTO</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-blue-600 bg-clip-text text-transparent leading-tight">
                        Resolvemos dudas<br class="sm:hidden"> en minutos
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 mt-3 sm:mt-4 max-w-3xl mx-auto leading-relaxed px-2">
                        Nuestro equipo está listo para ayudarte con cualquier pregunta sobre tus pedidos, publicaciones o pagos.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-12">
                    {{-- Formulario RESPONSIVE --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl sm:rounded-2xl p-4 sm:p-6 lg:p-8 border border-gray-200 shadow-lg">
                            <div id="soporte-message-container" class="mb-4 sm:mb-6 hidden"></div>

                            <form id="soporte-form" method="POST" action="{{ route('soporte.procesar') }}">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                    <div>
                                        <x-input-label for="full-name" value="Nombre completo" class="!text-sm sm:!text-base !font-bold !text-gray-700 mb-2 sm:mb-3 block" />
                                        <x-text-input type="text" name="full-name" id="full-name" 
                                                     class="w-full bg-gray-50 border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-base sm:text-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                                     required />
                                    </div>
                                    <div>
                                        <x-input-label for="email" value="Email" class="!text-sm sm:!text-base !font-bold !text-gray-700 mb-2 sm:mb-3 block" />
                                        <x-text-input type="email" name="email" id="email" 
                                                     class="w-full bg-gray-50 border-gray-300 rounded-lg sm:rounded-xl px-3 py-2 sm:px-4 sm:py-3 text-base sm:text-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                                     required />
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-6">
                                    <x-input-label for="message" value="Mensaje" class="!text-sm sm:!text-base !font-bold !text-gray-700 mb-2 sm:mb-3 block" />
                                    <textarea name="message" id="message" rows="5" 
                                             class="w-full bg-gray-50 border-gray-300 rounded-lg sm:rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base sm:text-lg px-3 py-2 sm:px-4 sm:py-3 transition-all duration-300" 
                                             placeholder="Describe tu consulta o problema..." required></textarea>
                                </div>
                                <div class="mt-6 sm:mt-8">
                                    <x-primary-button type="submit" class="w-full sm:w-auto !bg-gradient-to-r !from-blue-500 !to-cyan-500 hover:!from-blue-600 hover:!to-cyan-600 !px-6 sm:!px-10 !py-3 sm:!py-4 !text-base sm:!text-lg !font-bold !rounded-xl sm:!rounded-2xl transform hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Enviar Mensaje
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Sidebar de Información RESPONSIVE --}}
                    <div class="space-y-4 sm:space-y-6">
                        {{-- FAQs RESPONSIVE --}}
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-blue-200 shadow-lg">
                            <h3 class="font-bold text-blue-800 text-lg sm:text-xl mb-3 sm:mb-4 flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
                                </svg>
                                FAQs Rápidas
                            </h3>
                            <ul class="space-y-3 sm:space-y-4">
                                <li class="bg-white p-3 sm:p-4 rounded-lg sm:rounded-xl border border-blue-100 hover:shadow-md transition-all duration-300">
                                    <div class="flex items-start space-x-2 sm:space-x-3">
                                        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 text-sm sm:text-base">Pagos Seguros</p>
                                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Aceptamos las principales tarjetas a través de Stripe y MercadoPago.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="bg-white p-3 sm:p-4 rounded-lg sm:rounded-xl border border-blue-100 hover:shadow-md transition-all duration-300">
                                    <div class="flex items-start space-x-2 sm:space-x-3">
                                        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v11h2c0 1.66 1.34 3 3 3s3-1.34 3-3h6c0 1.66 1.34 3 3 3s3-1.34 3-3h2v-5l-3-4zM6 18.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm13.5-9l1.96 2.5H17V9.5h2.5zm-1.5 9c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 text-sm sm:text-base">Envíos Rápidos</p>
                                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Los tiempos de envío varían según el vendedor y tu ubicación.</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="bg-white p-3 sm:p-4 rounded-lg sm:rounded-xl border border-blue-100 hover:shadow-md transition-all duration-300">
                                    <div class="flex items-start space-x-2 sm:space-x-3">
                                        <div class="w-6 h-6 sm:w-8 sm:h-8 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 12h-2v-2h2v2zm0-4h-2V6h2v4z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800 text-sm sm:text-base">Devoluciones</p>
                                            <p class="text-xs sm:text-sm text-gray-600 mt-1">Política de 14 días para cambios y devoluciones.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        {{-- Información de Contacto RESPONSIVE --}}
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl sm:rounded-2xl p-4 sm:p-6 border border-emerald-200 shadow-lg">
                            <h3 class="font-bold text-emerald-800 text-lg sm:text-xl mb-3 sm:mb-4 flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                                Contacto Directo
                            </h3>
                            <div class="space-y-3 sm:space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm sm:text-base">Email</p>
                                        <p class="text-xs sm:text-sm text-gray-600">soporte@greencloset.com</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm sm:text-base">Horario</p>
                                        <p class="text-xs sm:text-sm text-gray-600">Lun-Vie: 9:00-18:00</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M23 12l-2.44-2.78.34-3.68-3.61-.82-1.89-3.18L12 3 8.6 1.54 6.71 4.72l-3.61.81.34 3.68L1 12l2.44 2.78-.34 3.69 3.61.82 1.89 3.18L12 21l3.4 1.46 1.89-3.18 3.61-.82-.34-3.68L23 12zm-10 5h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 text-sm sm:text-base">Respuesta</p>
                                        <p class="text-xs sm:text-sm text-gray-600">En menos de 24h</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Cambio de estilos por Joha -->
