@extends('layouts.admin')

@section('title', 'Productos Pendientes de Aprobación')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Productos Pendientes</h2>
                <p class="text-gray-600 text-sm mt-1">Revisa y aprueba las prendas subidas por usuarios</p>
            </div>
            
            <div class="flex space-x-3">
                <a href="{{ route('admin.productos.index') }}" 
                   class="inline-flex items-center justify-center bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition-colors">
                    Ver Productos Aprobados
                </a>
            </div>
        </div>

        <!-- Mensajes Flash -->
        @if (session('status_success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg text-sm flex items-center" role="alert">
                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('status_success') }}
            </div>
        @endif

        <!-- Tabla de Productos Pendientes -->
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-amber-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">Imagen</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">Vendedor</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">Fecha Subida</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-amber-700 uppercase tracking-wide">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($productos as $producto)
                        <tr class="hover:bg-amber-50/50 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-900 font-medium">{{ $producto->id }}</td>
                            <td class="px-4 py-3 text-sm">
                                @php
                                    $imageUrl = $producto->usuario_id !== null 
                                        ? asset('storage/' . $producto->imagen_url)
                                        : asset($producto->imagen_url);
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" 
                                     class="w-10 h-12 object-cover rounded border border-gray-200">
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 max-w-xs">
                                <div class="font-medium">{{ $producto->nombre }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($producto->descripcion, 50) }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900 font-semibold">${{ number_format($producto->precio_final, 2) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ optional($producto->usuario)->nombre_completo ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm text-gray-600">{{ $producto->fecha_creacion->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-sm font-medium">
                                <div class="flex items-center space-x-2">
                                    <!-- Botón Aprobar -->
                                    <form action="{{ route('admin.productos.aprobar', $producto) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs rounded-lg hover:bg-green-700 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Aprobar
                                        </button>
                                    </form>
                                    
                                    <!-- Botón Rechazar -->
                                    <a href="{{ route('admin.productos.mostrar-rechazar', $producto) }}"
                                       class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Rechazar
                                    </a>
                                    
                                    <!-- Ver Detalles -->
                                    <a href="{{ route('producto.show', $producto) }}" 
                                       target="_blank"
                                       class="inline-flex items-center px-3 py-1 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Ver
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-amber-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                    <p class="text-gray-600 font-medium">No hay productos pendientes de aprobación</p>
                                    <p class="text-gray-500 text-sm mt-1">Todos los productos han sido revisados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection