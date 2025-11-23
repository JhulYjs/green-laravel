<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                    {{ __('Mis Prendas Publicadas') }}
                </h2>
            </div>
            
            {{-- Botón Agregar Prenda en Header (visible en desktop) --}}
            <div class="hidden sm:block">
                <a href="{{ route('mis-prendas.subir-prenda') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-0.5 transition-all duration-300 shadow-md">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Agregar Prenda
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje de éxito/error --}}
            @if (session('status'))
                <div class="mb-6 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 rounded-2xl p-6 shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-6 sm:p-8 text-gray-900">
                    {{-- Header Principal --}}
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8 sm:mb-12">
                        <div class="text-center sm:text-left">
                            <div class="inline-flex items-center space-x-2 bg-emerald-100 px-4 sm:px-6 py-2 sm:py-3 rounded-full mb-3 sm:mb-4">
                                <span class="text-emerald-600">👤</span>
                                <span class="text-xs sm:text-sm font-bold text-emerald-700 uppercase tracking-wider">MI CUENTA</span>
                            </div>
                            <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent leading-tight">
                                Mis Prendas Publicadas
                            </h1>
                            <p class="text-gray-600 mt-2 sm:mt-3 text-sm sm:text-lg">Gestiona tu colección de moda circular</p>
                        </div>
                        
                        {{-- Botón Agregar Prenda en contenido (visible en móvil) --}}
                        <div class="sm:hidden flex justify-center">
                            <a href="{{ route('mis-prendas.subir-prenda') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-0.5 transition-all duration-300 shadow-md w-full justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Agregar Prenda
                            </a>
                        </div>
                    </div>

                    @if ($prendas->isEmpty())
                        {{-- Estado Vacío --}}
                        <div class="mt-8 sm:mt-12 bg-gradient-to-br from-gray-50 to-emerald-50 border-2 border-dashed border-emerald-200 rounded-2xl py-12 sm:py-20 px-4 sm:px-6 text-center shadow-inner">
                            <div class="w-16 h-16 sm:w-24 sm:h-24 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                                <svg class="w-8 h-8 sm:w-12 sm:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-700 mb-2 sm:mb-3">Aún no has subido ninguna prenda</h3>
                            <p class="text-gray-600 max-w-md mx-auto leading-relaxed text-sm sm:text-base">
                                ¡Comparte tu estilo con la comunidad y da una segunda vida a tu ropa!
                            </p>
                            <div class="mt-6 sm:mt-8">
                                <a href="{{ route('mis-prendas.subir-prenda') }}" 
                                    class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold rounded-xl sm:rounded-2xl shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Subir mi primera prenda
                                </a>
                            </div>
                        </div>
                    @else
                        {{-- Lista de Prendas --}}
                        <div class="mt-8 sm:mt-12 space-y-4 sm:space-y-6">
                            @foreach ($prendas as $prenda)
                                <div class="bg-white rounded-xl sm:rounded-2xl border border-gray-200 shadow-lg p-4 sm:p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-4 lg:space-x-6">
                                        {{-- Imagen --}}
                                        @php
                                            // Si la URL ya empieza con http (es externa) o no usa storage
                                            if (Str::startsWith($producto->imagen_url, 'http')) {
                                                $imageUrl = $producto->imagen_url;
                                            } else {
                                                // Siempre usamos storage para subidas locales
                                                $imageUrl = asset('storage/' . $producto->imagen_url);
                                            }
                                        @endphp
                                        <img src="{{ $imageUrl }}" alt="{{ $prenda->nombre }}" 
                                             class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-xl sm:rounded-2xl border-2 border-emerald-200 shadow-md flex-shrink-0">
                                        
                                        {{-- Información --}}
                                        <div class="flex-grow min-w-0">
                                            <h3 class="text-lg sm:text-xl font-bold text-gray-800 truncate">{{ $prenda->nombre }}</h3>
                                            <div class="mt-2">
                                                @if($prenda->estaPendiente())
                                                    <span class="inline-flex items-center bg-amber-100 text-amber-800 px-2 py-1 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                        </svg>
                                                        En espera de aprobación
                                                    </span>
                                                @elseif($prenda->estaAprobado())
                                                    <span class="inline-flex items-center bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Aprobado
                                                    </span>
                                                @elseif($prenda->estaRechazado())
                                                    <span class="inline-flex items-center bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                        </svg>
                                                        Rechazado
                                                        @if($prenda->motivo_rechazo)
                                                            <span class="ml-1" title="{{ $prenda->motivo_rechazo }}">ⓘ</span>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="flex flex-wrap items-center gap-2 sm:gap-4 mt-3">
                                                <span class="inline-flex items-center bg-gradient-to-r from-emerald-50 to-teal-50 px-2 sm:px-3 py-1 rounded-full text-emerald-700 font-semibold text-xs sm:text-sm">
                                                    💰 ${{ number_format($prenda->precio_final, 2) }}
                                                </span>
                                                <span class="inline-flex items-center bg-gradient-to-r from-blue-50 to-cyan-50 px-2 sm:px-3 py-1 rounded-full text-blue-700 font-semibold text-xs sm:text-sm">
                                                    📏 {{ $prenda->talla }}
                                                </span>
                                                <span class="inline-flex items-center bg-gradient-to-r from-amber-50 to-orange-50 px-2 sm:px-3 py-1 rounded-full text-amber-700 font-semibold text-xs sm:text-sm">
                                                    ⭐ {{ $prenda->estado }}
                                                </span>
                                            </div>
                                            <p class="text-xs sm:text-sm text-gray-500 mt-2 sm:mt-3">
                                                📅 Publicado: {{ $prenda->fecha_creacion->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        
                                        {{-- Acciones --}}
                                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 lg:space-x-3 flex-shrink-0 w-full md:w-auto">
                                            {{-- Editar --}}
                                            <a href="{{ route('mis-prendas.edit', $prenda) }}"
                                               class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-lg sm:rounded-xl hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-0.5 transition-all duration-300 shadow-md text-sm sm:text-base">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Editar
                                            </a>
                                            
                                            {{-- Eliminar --}}
                                            <form action="{{ route('mis-prendas.destroy', $prenda) }}" method="POST" 
                                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta prenda? Esta acción no se puede deshacer.');"
                                                  class="w-full sm:w-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-gradient-to-r from-red-500 to-pink-500 text-white font-semibold rounded-lg sm:rounded-xl hover:from-red-600 hover:to-pink-600 transform hover:-translate-y-0.5 transition-all duration-300 shadow-md w-full text-sm sm:text-base">
                                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Footer --}}
                    <div class="mt-8 sm:mt-12 text-center border-t border-gray-200 pt-6 sm:pt-8">
                        <a href="{{ route('coleccion') }}" 
                           class="inline-flex items-center px-6 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-bold rounded-xl sm:rounded-2xl border border-gray-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300 text-sm sm:text-base">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver al inicio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Botón flotante para móvil --}}
    <div class="fixed bottom-6 right-6 z-50 sm:hidden">
        <a href="{{ route('mis-prendas.subir-prenda') }}" 
           class="flex items-center justify-center w-14 h-14 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full shadow-lg hover:from-emerald-600 hover:to-teal-600 transform hover:scale-110 transition-all duration-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>
    </div>
</x-app-layout>
<!-- Cambio de estilos por Joha -->
