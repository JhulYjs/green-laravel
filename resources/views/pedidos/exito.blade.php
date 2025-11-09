<x-app-layout>
    {{-- No necesitamos un header específico aquí --}}

    <main class="py-24 text-center" style="background: linear-gradient(135deg, #F5F1E6 0%, #E8DFCA 100%);">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl p-12 border-0" style="box-shadow: 0 10px 30px rgba(226, 114, 91, 0.15);">
                {{-- Icono de éxito --}}
                <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #E2725B 0%, #D4A017 100%);">
                    <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h1 class="text-4xl font-bold mt-6" style="color: #3E2723;">¡Gracias por tu compra!</h1>
                <p class="text-lg mt-3" style="color: #8A9B68;">Tu pedido ha sido procesado correctamente.</p>
                <div class="mt-6 p-4 rounded-lg inline-block" style="background-color: #F5F1E6;">
                    <p class="text-base">
                        Tu número de pedido es: <strong class="text-xl" style="color: #E2725B;">#{{ $pedido->id }}</strong>
                    </p>
                </div>
                <p class="mt-4 text-base" style="color: #8A9B68;">
                    Recibirás un email con los detalles de tu compra y el seguimiento del envío.
                </p>
                
                {{-- Enlace para seguir explorando --}}
                <a href="{{ route('home') }}"
                   class="inline-block mt-8 px-10 py-4 rounded-full font-bold text-base transition-all duration-300 transform hover:scale-105"
                   style="background: linear-gradient(135deg, #E2725B 0%, #D4A017 100%); color: white; box-shadow: 0 4px 15px rgba(226, 114, 91, 0.4);">
                    Seguir explorando
                </a>
            </div>
        </div>
    </main>
</x-app-layout>
<!-- Cambio de estilos por Joha -->
