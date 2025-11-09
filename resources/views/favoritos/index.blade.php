<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                {{ __('Mis Favoritos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-8 text-gray-900">

                    {{-- Header Mejorado --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center space-x-2 bg-red-100 px-6 py-3 rounded-full mb-4">
                            <span class="text-red-600">❤️</span>
                            <span class="text-sm font-bold text-red-700 uppercase tracking-wider">TUS FAVORITOS</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-red-600 bg-clip-text text-transparent">
                            Tus hallazgos circulares
                        </h1>
                        <p class="text-gray-600 mt-3 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                            Las prendas que más te han enamorado, guardadas para que no se te escapen
                        </p>
                    </div>

                    {{-- Contador de Favoritos --}}
                    @if($productosFavoritos->count() > 0)
                    <div class="flex justify-center mb-12">
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 sm:px-8 py-4 rounded-2xl border border-red-200 shadow-lg w-full max-w-md">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                                    <span class="text-white text-xl font-bold">{{ $productosFavoritos->count() }}</span>
                                </div>
                                <div>
                                    <p class="font-bold text-red-700 text-lg">
                                        {{ $productosFavoritos->count() }} 
                                        {{ $productosFavoritos->count() === 1 ? 'artículo guardado' : 'artículos guardados' }}
                                    </p>
                                    <p class="text-sm text-red-600">En tu lista de deseos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Grid de Productos Favoritos --}}
                    @forelse ($productosFavoritos as $producto)
                        {{-- Abre el grid solo si es el primer elemento --}}
                        @if ($loop->first)
                            <div id="favorites-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 sm:gap-8">
                        @endif

                        {{-- Tarjeta del Producto --}}
                        @include('productos.partials.card', ['producto' => $producto])

                        {{-- Cierra el grid solo si es el último elemento --}}
                        @if ($loop->last)
                            </div>
                        @endif

                    {{-- Estado Vacío --}}
                    @empty
                        <div class="text-center bg-gradient-to-br from-red-50 to-pink-50 border-2 border-dashed border-red-200 rounded-2xl py-16 sm:py-20 px-6 mt-8 shadow-inner">
                            {{-- Icono de corazón con animación --}}
                            <div class="relative inline-block mb-8">
                                <div class="w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-r from-red-200 to-pink-200 rounded-full flex items-center justify-center mx-auto shadow-lg">
                                    <svg class="w-12 h-12 sm:w-16 sm:h-16 text-red-300 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-3xl sm:text-4xl">💔</span>
                                </div>
                            </div>
                            
                            <h3 class="text-2xl sm:text-3xl font-bold text-gray-700 mb-4">Tu lista de favoritos está vacía</h3>
                            <p class="text-gray-600 max-w-md mx-auto leading-relaxed text-base sm:text-lg mb-8">
                                Guarda tus prendas favoritas haciendo clic en el corazón para encontrarlas fácilmente más tarde. 
                                ¡Descubre piezas únicas con historia!
                            </p>
                            
                            {{-- Botones de acción - USANDO LAS RUTAS ORIGINALES --}}
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center px-6 sm:px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 text-sm sm:text-base">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Descubrir Colección
                                </a>
                                
                                {{-- Esta es la línea que causaba el error - LA HE CORREGIDO --}}
                                <a href="{{ route('coleccion') }}" 
                                   class="inline-flex items-center px-6 sm:px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-bold rounded-2xl border border-gray-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 text-sm sm:text-base">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    Ver Todo el Catálogo
                                </a>
                            </div>

                            {{-- Tips --}}
                            <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                                <div class="text-center p-4">
                                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                                        <div class="relative">
                                            <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                            <div class="absolute -top-1 -right-1 w-4 h-4 bg-white rounded-full border border-red-300"></div>
                                            <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full animate-pulse"></div>
                                        </div>
                                    </div>
                                    <p class="font-semibold text-gray-700">Haz clic en el corazón</p>
                                    <p class="text-sm text-gray-600 mt-1">En cualquier producto para guardarlo</p>
                                </div>
                                
                                <div class="text-center p-4">
                                    <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                                        <div class="relative">
                                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                            <div class="absolute -bottom-1 -right-1 w-5 h-3 bg-amber-500 rounded-sm"></div>
                                        </div>
                                    </div>
                                    <p class="font-semibold text-gray-700">Acceso rápido</p>
                                    <p class="text-sm text-gray-600 mt-1">Encuentra tus favoritos fácilmente</p>
                                </div>
                                
                                <div class="text-center p-4">
                                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm">
                                        <div class="relative">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <div class="absolute -top-1 -right-1 w-5 h-5 bg-green-500 rounded-full flex items-center justify-center">
                                                <span class="text-white text-xs font-bold">+</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="font-semibold text-gray-700">Compra más tarde</p>
                                    <p class="text-sm text-gray-600 mt-1">No pierdas tus artículos preferidos</p>
                                </div>
                            </div>
                        </div>
                    @endforelse

                    {{-- SOLUCIÓN: Eliminar la paginación o verificar si es un objeto Paginator --}}
                    {{-- Opción 1: Eliminar completamente la paginación --}}
                    {{-- 
                    @if($productosFavoritos->hasPages())
                    <div class="mt-12 flex justify-center">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 px-6 py-4">
                            {{ $productosFavoritos->links() }}
                        </div>
                    </div>
                    @endif
                    --}}

                    {{-- Opción 2: Verificar si es paginable --}}
                    @if(method_exists($productosFavoritos, 'links') && $productosFavoritos->hasPages())
                    <div class="mt-12 flex justify-center">
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 px-6 py-4">
                            {{ $productosFavoritos->links() }}
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
</x-app-layout>