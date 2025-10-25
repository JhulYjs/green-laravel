<x-app-layout>
    <x-slot name="header">
<<<<<<< HEAD
        <h2 class="font-semibold text-xl leading-tight" style="color: #3E2723;">
=======
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
            {{ __('Historial de Pedidos') }}
        </h2>
    </x-slot>

<<<<<<< HEAD
    <div class="py-12" style="background: linear-gradient(135deg, #F5F1E6 0%, #E8DFCA 100%); min-height: 80vh;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje Flash si viene de otra acción --}}
            @if (session('status'))
                <div class="mb-6 rounded-xl p-4 border-l-4" style="background-color: #E8F5E8; border-color: #8A9B68; color: #2E5C2E;" role="alert">
=======
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje Flash si viene de otra acción --}}
            @if (session('status'))
                <div class="mb-6 bg-green-100 border border-green-200 text-sm text-green-700 rounded-md p-4" role="alert">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                    {{ session('status') }}
                </div>
            @endif

<<<<<<< HEAD
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl">
                <div class="p-8">
                    <p class="text-sm font-semibold uppercase tracking-wider" style="color: #E2725B;">Mi Cuenta</p>
                    <h1 class="text-3xl md:text-4xl font-bold font-serif mt-1" style="color: #3E2723;">Historial de Pedidos</h1>

                    @if ($pedidos->isEmpty())
                        <div class="mt-10 bg-white p-10 rounded-2xl text-center border-2 border-dashed" style="border-color: #E8DFCA;">
                            <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center" style="background-color: #F5F1E6;">
                                <svg class="h-10 w-10" style="color: #8A9B68;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                            </div>
                            <h3 class="mt-6 text-xl font-semibold" style="color: #3E2723;">Aún no tienes pedidos</h3>
                            <p class="mt-2" style="color: #8A9B68;">¡Explora nuestra colección y encuentra tu próxima prenda!</p>
                            <a href="{{ route('home') }}" class="inline-block mt-6 px-8 py-3 rounded-full font-semibold text-sm transition-all duration-300 transform hover:scale-105"
                               style="background: linear-gradient(135deg, #E2725B 0%, #D4A017 100%); color: white; box-shadow: 0 4px 10px rgba(226, 114, 91, 0.3);">
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                Ver Colección
                            </a>
                        </div>
                    @else
<<<<<<< HEAD
                        <div class="mt-10 overflow-hidden border rounded-2xl shadow-sm" style="border-color: #E8DFCA;">
                            <table class="min-w-full divide-y" style="border-color: #E8DFCA;">
                                <thead class="bg-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #E2725B; background-color: #F5F1E6;">Pedido #</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #E2725B; background-color: #F5F1E6;">Fecha</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #E2725B; background-color: #F5F1E6;">Total</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #E2725B; background-color: #F5F1E6;">Estado</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: #E2725B; background-color: #F5F1E6;">Detalles</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y" style="border-color: #E8DFCA;">
                                    @foreach ($pedidos as $pedido)
                                        <tr class="transition-colors duration-200 hover:bg-orange-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" style="color: #3E2723;">#{{ $pedido->id }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm" style="color: #8A9B68;">{{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: #E2725B;">${{ number_format($pedido->total, 2) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
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
<<<<<<< HEAD
                                             <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                 <a href="{{ route('mis-pedidos.show', $pedido) }}"
                                                    class="font-semibold transition-colors duration-200 hover:underline"
                                                    style="color: #D4A017;">
                                                    Ver detalles
                                                 </a>
                                             </td>
=======
                                             <td class="px-6 py-4 whitespace-nowrap text-sm text-brand-500">
                                                 {{-- Enlace a la ruta de detalle --}}
                                                 <a href="{{ route('mis-pedidos.show', $pedido) }}"
                                                    class="text-brand-600 hover:text-brand-800 hover:underline font-semibold">Ver</a>
                                                 </td>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="mt-8 text-center">
<<<<<<< HEAD
                        <a href="{{ route('home') }}" class="text-sm font-semibold transition-colors duration-200 flex items-center justify-center" style="color: #E2725B;">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Volver al inicio
                        </a>
=======
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800">&larr; Volver al inicio</a>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>