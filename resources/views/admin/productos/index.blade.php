@extends('layouts.admin')

@section('title', 'Gestión de Productos')

@section('content')
    <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-brand-800">Listado de Productos</h2>
            
            {{-- === BOTÓN AGREGAR PRODUCTO === --}}
            <a href="{{ route('admin.productos.create') }}" 
               class="bg-brand-500 text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-brand-600 transition-colors flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Agregar Producto
            </a>
            {{-- ============================== --}}
        </div>

        {{-- Mensajes Flash --}}
        @if (session('status_success'))
            <div class="mb-4 bg-green-100 border border-green-200 text-green-700 p-3 rounded-lg text-sm" role="alert">
                {{ session('status_success') }}
            </div>
        @elseif (session('status_error'))
            <div class="mb-4 bg-red-100 border border-red-200 text-red-700 p-3 rounded-lg text-sm" role="alert">
                {{ session('status_error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-brand-100">
                <thead class="bg-brand-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Imagen</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Vendedor</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-brand-100">
                    @forelse ($productos as $producto)
                        <tr>
                            <td class="px-6 py-4 text-sm text-brand-900">{{ $producto->id }}</td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $imageUrl = $producto->usuario_id !== null 
                                        ? asset('storage/' . $producto->imagen_url) // Subido por Admin
                                        : asset($producto->imagen_url); // Seeder (en /public)
                                @endphp
                                <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" class="w-10 h-12 object-cover rounded border">
                            </td>
                            <td class="px-6 py-4 text-sm text-brand-700 max-w-xs truncate">{{ $producto->nombre }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700 font-semibold">${{ number_format($producto->precio_final, 2) }}</td>
                            {{-- Accedemos al nombre del vendedor a través de la relación cargada --}}
                            {{-- Usamos optional() por si el usuario fue borrado (usuario_id es NULL) --}}
                            <td class="px-6 py-4 text-sm text-brand-500">{{ optional($producto->usuario)->nombre_completo ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-brand-500">{{ $producto->fecha_creacion->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                {{-- Enlace para Editar --}}
                                <a href="{{ route('admin.productos.edit', $producto) }}"
                                   class="text-brand-600 hover:text-brand-900 mr-3"> Editar
                                </a>
                                {{-- Formulario para Eliminar --}}
                                <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                       Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-brand-500">No se encontraron productos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
             {{-- Si usaste paginación en el controlador --}}
            {{-- <div class="mt-4">
                {{ $productos->links() }}
            </div> --}}
        </div>
    </div>
@endsection