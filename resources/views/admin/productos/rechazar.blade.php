@extends('layouts.admin')

@section('title', 'Rechazar Producto')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 max-w-2xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Rechazar Producto</h2>
            <p class="text-gray-600 text-sm mt-1">Especifica el motivo del rechazo</p>
        </div>

        <!-- Información del Producto -->
        <div class="bg-gray-50 rounded-lg p-4 mb-6">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $producto->imagen_url) }}" 
                     alt="{{ $producto->nombre }}" 
                     class="w-16 h-20 object-cover rounded border border-gray-200">
                <div>
                    <h3 class="font-semibold text-gray-900">{{ $producto->nombre }}</h3>
                    <p class="text-sm text-gray-600">Precio: ${{ number_format($producto->precio_final, 2) }}</p>
                    <p class="text-sm text-gray-600">Vendedor: {{ optional($producto->usuario)->nombre_completo ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Formulario de Rechazo -->
        <form action="{{ route('admin.productos.rechazar', $producto) }}" method="POST">
            @csrf
            @method('PATCH')
            
            <div class="mb-6">
                <label for="motivo_rechazo" class="block text-sm font-medium text-gray-700 mb-2">
                    Motivo del rechazo *
                </label>
                <textarea name="motivo_rechazo" id="motivo_rechazo" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500"
                          placeholder="Explica por qué estás rechazando este producto..."
                          required></textarea>
                @error('motivo_rechazo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.productos.pendientes') }}"
                   class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                        onclick="return confirm('¿Estás seguro de que quieres rechazar este producto?')">
                    Rechazar Producto
                </button>
            </div>
        </form>
    </div>
@endsection