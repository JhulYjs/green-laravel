<x-app-layout>
    {{-- No necesitamos un header específico aquí --}}

    <main class="py-24 text-center">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 border border-gray-100">
                {{-- Icono de éxito --}}
                <svg class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                
                <h1 class="text-3xl font-bold text-brand-800 font-serif mt-4">¡Gracias por tu compra!</h1>
                <p class="text-brand-600 mt-2">Tu pedido ha sido procesado correctamente.</p>
                <p class="text-sm text-brand-500 mt-4">
                    Tu número de pedido es: <strong class="text-brand-700">#{{ $pedido->id }}</strong> {{-- Accedemos al ID del pedido --}}
                </p>
                <p class="mt-2 text-sm text-brand-500">Recibirás un email con los detalles de tu compra y el seguimiento del envío (funcionalidad pendiente).</p>
                
                {{-- Enlace para seguir explorando --}}
                <a href="{{ route('home') }}" {{-- Usamos el nombre de la ruta de inicio --}}
                   class="inline-block mt-8 bg-brand-500 text-white px-8 py-3 rounded-full font-semibold text-sm hover:bg-brand-600">
                    Seguir explorando
                </a>
            </div>
        </div>
    </main>
</x-app-layout>