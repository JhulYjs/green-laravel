@extends('layouts.admin')

@section('title', 'Gestión de Pedidos')

@section('content')
    <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
        <h2 class="text-xl font-semibold text-brand-800 mb-4">Listado de Pedidos</h2>

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
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">ID Pedido</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Comprador</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-brand-100">
                    @forelse ($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4 text-sm text-brand-900 font-medium">#{{ $pedido->id }}</td>
                            <td class="px-6 py-4 text-sm text-brand-500">{{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700">{{ optional($pedido->usuario)->nombre_completo ?? 'Usuario eliminado' }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700 font-semibold">${{ number_format($pedido->total, 2) }}</td>
                            <td class="px-6 py-4 text-sm">
                                @php
                                    $estadoClase = match($pedido->estado) {
                                        'Entregado' => 'bg-green-100 text-green-800',
                                        'Enviado' => 'bg-blue-100 text-blue-800',
                                        'Cancelado' => 'bg-red-100 text-red-800',
                                        'Procesando' => 'bg-yellow-100 text-yellow-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClase }}">
                                    {{ $pedido->estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <a href="{{ route('admin.pedidos.show', $pedido) }}" {{-- Enlace a la vista de detalle --}}
                                   class="text-brand-600 hover:text-brand-900">
                                   Ver Detalles
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-brand-500">No se encontraron pedidos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
             {{-- Si usaste paginación en el controlador --}}
            {{-- <div class="mt-4">
                {{ $pedidos->links() }}
            </div> --}}
        </div>
    </div>
@endsection