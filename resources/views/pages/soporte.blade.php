<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Soporte y Contacto') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">SOPORTE Y CONTACTO</p>
                <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Resolvemos dudas en minutos</h1>
                <p class="text-brand-600 mt-2 max-w-3xl">Nuestro equipo está listo para ayudarte con cualquier pregunta sobre tus pedidos, publicaciones o pagos.</p>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10">
                    <div class="lg:col-span-2 bg-white rounded-lg p-0 border border-brand-100 shadow-sm">

                        <div id="soporte-message-container" class="mb-6 hidden"></div>

                        {{-- El formulario enviará la data por AJAX --}}
                        <form id="soporte-form" method="POST" action="{{ route('soporte.procesar') }}">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="full-name" value="Nombre completo" class="!text-sm !font-medium !text-brand-600 mb-2 block" />
                                    <x-text-input type="text" name="full-name" id="full-name" class="w-full bg-brand-50 border-brand-200" required />
                                </div>
                                <div>
                                    <x-input-label for="email" value="Email" class="!text-sm !font-medium !text-brand-600 mb-2 block" />
                                    <x-text-input type="email" name="email" id="email" class="w-full bg-brand-50 border-brand-200" required />
                                </div>
                            </div>
                            <div class="mt-6">
                                <x-input-label for="message" value="Mensaje" class="!text-sm !font-medium !text-brand-600 mb-2 block" />
                                <textarea name="message" id="message" rows="5" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required></textarea>
                            </div>
                            <div class="mt-6">
                                <x-primary-button type="submit" class="w-full sm:w-auto !bg-brand-500 hover:!bg-brand-600 !px-8 !py-3">
                                    Enviar Mensaje
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-6 border border-brand-100 shadow-sm">
                            <h3 class="font-semibold text-brand-800">FAQs rápidas</h3>
                            <ul class="mt-3 text-sm text-brand-600 space-y-3">
                                <li><strong>Pagos:</strong> Aceptamos las principales tarjetas a través de Stripe y MercadoPago.</li>
                                <li><strong>Envíos:</strong> Los tiempos de envío varían según el vendedor y tu ubicación.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>