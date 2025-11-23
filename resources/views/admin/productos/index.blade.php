@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Listado de Productos</h2>
                <p class="text-gray-600 text-sm mt-1">Gestiona todos los productos de tu tienda</p>
            </div>
            
            <!-- Botón Agregar Producto -->
            <a href="{{ route('admin.productos.create') }}" 
               class="inline-flex items-center justify-center bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors w-full sm:w-auto">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Agregar Producto
            </a>
        </div>

        <!-- Mensajes Flash -->
        @if (session('status_success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg text-sm flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('status_success') }}
            </div>
        @elseif (session('status_error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg text-sm flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                {{ session('status_error') }}
            </div>
        @endif

        <!-- Tabla de Productos -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Imagen</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Vendedor</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($productos as $producto)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900 font-medium">{{ $producto->id }}</td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    // Usamos la misma lógica que en el catálogo
                                    $imageUrl = \Illuminate\Support\Str::startsWith($producto->imagen_url, 'http') 
                                        ? $producto->imagen_url 
                                        : asset('storage/' . $producto->imagen_url);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" 
                                     class="w-10 h-12 object-cover rounded border border-gray-200">
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 max-w-xs truncate">{{ $producto->nombre }}</td>
                            <td class="px-4 py-3 text-sm text-gray-900 font-semibold">${{ number_format($producto->precio_final, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ optional($producto->usuario)->nombre_completo ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $producto->fecha_creacion->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <!-- Enlace para Editar -->
                                    <a href="{{ route('admin.productos.edit', $producto) }}"
                                       class="inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </a>
                                    <!-- Formulario para Eliminar -->
                                    <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" 
                                          class="inline" 
                                          onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center text-red-600 hover:text-red-900 transition-colors">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <p class="text-gray-600 font-medium">No se encontraron productos</p>
                                    <p class="text-gray-500 text-sm mt-1">Comienza agregando tu primer producto</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación (si existe) -->
        @if(method_exists($productos, 'links') && $productos->hasPages())
            <div class="mt-6">
                {{ $productos->links() }}
            </div>
        @endif
    </div>
@endsection