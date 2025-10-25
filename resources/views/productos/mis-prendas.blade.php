<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Prendas Publicadas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje de éxito/error (Flash Message) --}}
            @if (session('status'))
                <div class="mb-6 bg-green-100 border border-green-200 text-sm text-green-700 rounded-md p-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">Mi Cuenta</p>
                    <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Mis Prendas Publicadas</h1>

                    @if ($prendas->isEmpty())
                        <div class="mt-10 bg-white p-8 rounded-lg border border-dashed border-gray-200 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <h3 class="mt-4 text-xl font-semibold text-brand-700">Aún no has subido ninguna prenda</h3>
                            <p class="text-brand-500 mt-2">¡Comparte tu estilo con la comunidad!</p>
                            {{-- Aquí podríamos enlazar a la ruta para subir prendas si la hubiéramos creado --}}
                            {{-- <a href="{{ route('prendas.create') }}" class="inline-block mt-6 bg-brand-500 text-white px-6 py-2 rounded-full font-semibold text-sm hover:bg-brand-600">
                                Subir mi primera prenda
                            </a> --}}
                        </div>
                    @else
                        <div class="mt-10 space-y-4">
                            @foreach ($prendas as $prenda)
                                <div class="bg-white rounded-lg border border-gray-100 shadow-sm p-4 flex items-center space-x-4">
                                    <img src="{{ asset($prenda->imagen_url) }}" alt="{{ $prenda->nombre }}" class="w-20 h-20 object-cover rounded-lg border flex-shrink-0">
                                    <div class="flex-grow min-w-0">
                                        <h3 class="text-lg font-semibold text-brand-800 truncate">{{ $prenda->nombre }}</h3>
                                        <div class="text-sm text-brand-600 mt-1">
                                            <span>Precio: ${{ number_format($prenda->precio_final, 2) }}</span> |
                                            <span>Talla: {{ $prenda->talla }}</span> |
                                            <span>Estado: {{ $prenda->estado }}</span>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-1">Publicado: {{ $prenda->fecha_creacion->format('d/m/Y') }}</p> {{-- Formateamos la fecha --}}
                                    </div>
                                    <div class="flex-shrink-0 space-x-2">
                                        {{-- Enlace para Editar --}}
                                        <a href="{{ route('mis-prendas.edit', $prenda) }}"
                                           class="text-xs font-semibold text-brand-500 hover:text-brand-700 hover:underline px-2 py-1 bg-brand-100 hover:bg-brand-200 rounded">Editar</a>
                                        
                                        {{-- Formulario para Eliminar (usa método DELETE) --}}
                                        <form action="{{ route('mis-prendas.destroy', $prenda) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta prenda? Esta acción no se puede deshacer.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-xs font-semibold text-red-500 hover:text-red-700 hover:underline px-2 py-1 bg-red-50 hover:bg-red-100 rounded">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
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