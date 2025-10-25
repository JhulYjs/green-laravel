<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Favoritos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        @include('productos.partials.card', ['producto' => $producto])

                        {{-- Cierra el grid solo si es el último elemento --}}
                        @if ($loop->last)
                            </div>
                        @endif

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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>