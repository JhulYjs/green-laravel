<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent">
                {{ __('Soporte y Contacto') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200 p-8">
                {{-- Header --}}
                <div class="text-center mb-12">
                    <div class="inline-flex items-center space-x-2 bg-blue-100 px-6 py-3 rounded-full mb-6">
                        <span class="text-blue-600">💬</span>
                        <span class="text-sm font-bold text-blue-700 uppercase tracking-wider">SOPORTE Y CONTACTO</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-blue-600 bg-clip-text text-transparent">
                        Resolvemos dudas en minutos
                    </h1>
                    <p class="text-xl text-gray-600 mt-4 max-w-3xl mx-auto leading-relaxed">
                        Nuestro equipo está listo para ayudarte con cualquier pregunta sobre tus pedidos, publicaciones o pagos.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    {{-- Formulario --}}
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-lg">
                            <div id="soporte-message-container" class="mb-6 hidden"></div>

                            <form id="soporte-form" method="POST" action="{{ route('soporte.procesar') }}">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                    <div>
                                        <x-input-label for="full-name" value="Nombre completo" class="!text-base !font-bold !text-gray-700 mb-3 block" />
                                        <x-text-input type="text" name="full-name" id="full-name" 
                                                     class="w-full bg-gray-50 border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                                     required />
                                    </div>
                                    <div>
                                        <x-input-label for="email" value="Email" class="!text-base !font-bold !text-gray-700 mb-3 block" />
                                        <x-text-input type="email" name="email" id="email" 
                                                     class="w-full bg-gray-50 border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300" 
                                                     required />
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <x-input-label for="message" value="Mensaje" class="!text-base !font-bold !text-gray-700 mb-3 block" />
                                    <textarea name="message" id="message" rows="6" 
                                             class="w-full bg-gray-50 border-gray-300 rounded-xl shadow-sm focus:border-blue-500 focus:ring-blue-500 text-lg px-4 py-3 transition-all duration-300" 
                                             placeholder="Describe tu consulta o problema..." required></textarea>
                                </div>
                                <div class="mt-8">
                                    <x-primary-button type="submit" class="w-full sm:w-auto !bg-gradient-to-r !from-blue-500 !to-cyan-500 hover:!from-blue-600 hover:!to-cyan-600 !px-10 !py-4 !text-lg !font-bold !rounded-2xl transform hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                        Enviar Mensaje
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Sidebar de Información --}}
                    <div class="space-y-6">
                        {{-- FAQs --}}
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-200 shadow-lg">
                            <h3 class="font-bold text-blue-800 text-xl mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                FAQs Rápidas
                            </h3>
                            <ul class="space-y-4">
                                <li class="bg-white p-4 rounded-xl border border-blue-100">
                                    <p class="font-semibold text-gray-800">💳 Pagos</p>
                                    <p class="text-sm text-gray-600 mt-1">Aceptamos las principales tarjetas a través de Stripe y MercadoPago.</p>
                                </li>
                                <li class="bg-white p-4 rounded-xl border border-blue-100">
                                    <p class="font-semibold text-gray-800">🚚 Envíos</p>
                                    <p class="text-sm text-gray-600 mt-1">Los tiempos de envío varían según el vendedor y tu ubicación.</p>
                                </li>
                                <li class="bg-white p-4 rounded-xl border border-blue-100">
                                    <p class="font-semibold text-gray-800">↩️ Devoluciones</p>
                                    <p class="text-sm text-gray-600 mt-1">Política de 14 días para cambios y devoluciones.</p>
                                </li>
                            </ul>
                        </div>

                        {{-- Información de Contacto --}}
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-200 shadow-lg">
                            <h3 class="font-bold text-emerald-800 text-xl mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                Contacto Directo
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white">📧</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Email</p>
                                        <p class="text-sm text-gray-600">soporte@greencloset.com</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-amber-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white">🕒</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Horario</p>
                                        <p class="text-sm text-gray-600">Lun-Vie: 9:00-18:00</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                        <span class="text-white">⏱️</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Respuesta</p>
                                        <p class="text-sm text-gray-600">En menos de 24h</p>
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