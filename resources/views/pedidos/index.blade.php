<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje Flash si viene de otra acción --}}
            @if (session('status'))
                <div class="mb-6 bg-green-100 border border-green-200 text-sm text-green-700 rounded-md p-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">Mi Cuenta</p>
                    <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Historial de Pedidos</h1>

                    @if ($pedidos->isEmpty())
                        <div class="mt-10 bg-white p-8 rounded-lg border border-dashed border-gray-200 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            <h3 class="mt-4 text-xl font-semibold text-brand-700">Aún no tienes pedidos</h3>
                            <p class="text-brand-500 mt-2">¡Explora nuestra colección y encuentra tu próxima prenda!</p>
                            <a href="{{ route('home') }}" class="inline-block mt-6 bg-brand-500 text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-brand-600">
                                Ver Colección
                            </a>
                        </div>
                    @else
                        <div class="mt-10 overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Pedido #</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Fecha</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Total</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Estado</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Detalles</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-100">
                                    @foreach ($pedidos as $pedido)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-brand-800">#{{ $pedido->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-600">{{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</td> {{-- Formateamos Carbon date --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-700 font-semibold">${{ number_format($pedido->total, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{-- Lógica simple para clases de estado --}}
                                                @php
                                                    $estadoClase = match($pedido->estado) {
                                                        'Entregado' => 'bg-green-100 text-green-800',
                                                        'Enviado' => 'bg-blue-100 text-blue-800',
                                                        'Cancelado' => 'bg-red-100 text-red-800',
                                                        'Procesando' => 'bg-yellow-100 text-yellow-800',
                                                        default => 'bg-gray-100 text-gray-800'
                                                    };
                                                @endphp
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClase }}">
                                                    {{ $pedido->estado }}
                                                </span>
                                            </td>
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-500">
                                                 {{-- Enlace a la ruta de detalle --}}
                                                 <a href="{{ route('mis-pedidos.show', $pedido) }}"
                                                    class="text-brand-600 hover:text-brand-800 hover:underline font-semibold">Ver</a>
                                                 </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-8 text-center">
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800">&larr; Volver al inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>