<x-app-layout>
    <x-slot name="header">
<<<<<<< HEAD
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                {{ __('Mis Favoritos') }}
            </h2>
        </div>
=======
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Favoritos') }}
        </h2>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<<<<<<< HEAD
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-8 text-gray-900">

                    {{-- Header Mejorado --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center space-x-2 bg-red-100 px-6 py-3 rounded-full mb-4">
                            <span class="text-red-600">❤️</span>
                            <span class="text-sm font-bold text-red-700 uppercase tracking-wider">TUS FAVORITOS</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-red-600 bg-clip-text text-transparent">
                            Tus hallazgos circulares
                        </h1>
                        <p class="text-gray-600 mt-3 text-lg max-w-2xl mx-auto leading-relaxed">
                            Las prendas que más te han enamorado, guardadas para que no se te escapen
                        </p>
                    </div>

                    {{-- Contador de Favoritos --}}
                    @if($productosFavoritos->count() > 0)
                    <div class="flex justify-center mb-12">
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-8 py-4 rounded-2xl border border-red-200 shadow-lg">
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
                            <div id="favorites-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @endif

                        {{-- Tarjeta del Producto --}}
=======
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">FAVORITOS</p>
                    <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Tus hallazgos circulares</h1>

                    {{-- Usamos @forelse para manejar el caso de que no haya favoritos --}}
                    {{-- La variable $productosFavoritos viene del FavoritoController --}}
                    @forelse ($productosFavoritos as $producto)
                        {{-- Abre el grid solo si es el primer elemento (index 0) --}}
                        @if ($loop->first)
                            <div id="favorites-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-10">
                        @endif

                        {{-- Incluimos la vista parcial de la tarjeta del producto --}}
                        {{-- Le pasamos la variable $producto actual del bucle --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                        @include('productos.partials.card', ['producto' => $producto])

                        {{-- Cierra el grid solo si es el último elemento --}}
                        @if ($loop->last)
                            </div>
                        @endif

<<<<<<< HEAD
                    {{-- Estado Vacío --}}
                    @empty
                        <div class="text-center bg-gradient-to-br from-red-50 to-pink-50 border-2 border-dashed border-red-200 rounded-2xl py-20 px-6 mt-8 shadow-inner">
                            {{-- Icono de corazón con animación --}}
                            <div class="relative inline-block mb-8">
                                <div class="w-32 h-32 bg-gradient-to-r from-red-200 to-pink-200 rounded-full flex items-center justify-center mx-auto shadow-lg">
                                    <svg class="w-16 h-16 text-red-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path>
                                    </svg>
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-4xl">💔</span>
                                </div>
                            </div>
                            
                            <h3 class="text-2xl font-bold text-gray-700 mb-4">Tu lista de favoritos está vacía</h3>
                            <p class="text-gray-600 max-w-md mx-auto leading-relaxed text-lg mb-8">
                                Guarda tus prendas favoritas haciendo clic en el corazón para encontrarlas fácilmente más tarde. 
                                ¡Descubre piezas únicas con historia!
                            </p>
                            
                            {{-- Botones de acción - USANDO LAS RUTAS ORIGINALES --}}
                            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-2xl shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Descubrir Colección
                                </a>
                                
                                {{-- Esta es la línea que causaba el error - LA HE CORREGIDO --}}
                                <a href="{{ route('coleccion') }}" 
                                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-bold rounded-2xl border border-gray-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                    Ver Todo el Catálogo
                                </a>
                            </div>

                            {{-- Tips --}}
                            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
                                <div class="text-center p-4">
                                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <span class="text-2xl">❤️</span>
                                    </div>
                                    <p class="font-semibold text-gray-700">Haz clic en el corazón</p>
                                    <p class="text-sm text-gray-600 mt-1">En cualquier producto para guardarlo</p>
                                </div>
                                <div class="text-center p-4">
                                    <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <span class="text-2xl">📱</span>
                                    </div>
                                    <p class="font-semibold text-gray-700">Acceso rápido</p>
                                    <p class="text-sm text-gray-600 mt-1">Encuentra tus favoritos fácilmente</p>
                                </div>
                                <div class="text-center p-4">
                                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                                        <span class="text-2xl">🛒</span>
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
=======
                    {{-- Bloque @empty: se muestra si $productosFavoritos está vacío --}}
                    @empty
                        <div class="text-center bg-white border-2 border-dashed border-gray-200 rounded-lg py-16 px-6 mt-10">
                            {{-- Icono de corazón vacío --}}
                            <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 20.364l-7.682-7.682a4.5 4.5 0 010-6.364z"></path></svg>
                            <h3 class="mt-4 text-xl font-semibold text-gray-700">Tu lista de favoritos está vacía</h3>
                            {{-- Enlace a la colección --}}
                            <a href="{{ route('home') }}" class="inline-block mt-6 bg-brand-500 text-white px-8 py-3 rounded-full font-semibold">Descubrir Colección</a>
                        </div>
                    @endforelse {{-- Fin del @forelse --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503

                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD

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
=======
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
</x-app-layout>