@extends('layouts.admin')

@section('title', 'Detalle Pedido #' . $pedido->id)

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Botón Volver --}}
        <div class="mb-6">
            <a href="{{ route('admin.pedidos.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Volver a Pedidos
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg border border-brand-100 shadow-sm">
            {{-- Cabecera con Estado --}}
            <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 border-b border-brand-100 pb-4">
                <div>
                    <h1 class="text-2xl font-semibold text-brand-800 font-serif">Detalle Pedido #{{ $pedido->id }}</h1>
                    <p class="text-brand-500 mt-1 text-sm">Realizado el: {{ $pedido->fecha_pedido->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    @php
                        $estadoClase = match($pedido->estado) { /* Misma lógica de clases que en index */
                            'Entregado' => 'bg-green-100 text-green-800', 'Enviado' => 'bg-blue-100 text-blue-800',
                            'Cancelado' => 'bg-red-100 text-red-800', 'Procesando' => 'bg-yellow-100 text-yellow-800',
                            default => 'bg-gray-100 text-gray-800'
                        };
                    @endphp
                     <span class="px-3 py-1 mt-2 sm:mt-0 inline-flex text-xs leading-5 font-semibold rounded-full {{ $estadoClase }}">
                        Estado: {{ $pedido->estado }}
                     </span>
                </div>
            </div>

             {{-- Mensajes Flash (para actualización de estado) --}}
             @if (session('status_success'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 p-3 rounded-lg text-sm" role="alert">
                    {{ session('status_success') }}
                </div>
            @elseif (session('status_error'))
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 p-3 rounded-lg text-sm" role="alert">
                    {{ session('status_error') }}
                </div>
            @endif
             {{-- Errores de Validación (si los hubiera al actualizar estado) --}}
             @if ($errors->any())
                 <div class="mb-4 bg-red-100 border border-red-200 text-sm text-red-700 rounded-md p-4" role="alert">
                     <ul class="list-disc list-inside">
                         @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                     </ul>
                 </div>
             @endif


            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Columna Izquierda: Items --}}
                <div class="md:col-span-2 space-y-4">
                    <h2 class="text-lg font-semibold text-brand-700 mb-2">Artículos del Pedido</h2>
                    @forelse ($pedido->detalles as $item)
                        <div class="bg-brand-50 rounded-lg p-3 flex items-center space-x-3 border border-brand-100">
                            <img src="{{ asset(optional($item->producto)->imagen_url ?? 'placeholder.jpg') }}" 
                                 alt="{{ optional($item->producto)->nombre ?? 'Producto no disponible' }}" 
                                 class="w-12 h-16 object-cover rounded border flex-shrink-0">
                            <div class="flex-grow min-w-0">
                                <p class="text-sm font-semibold text-brand-800 truncate">
                                    {{-- Enlace al producto si existe --}}
                                    @if($item->producto)
                                        <a href="{{ route('producto.show', $item->producto) }}" target="_blank" class="hover:underline">
                                            {{ $item->producto->nombre }}
                                        </a>
                                    @else
                                        Producto no disponible
                                    @endif
                                </p>
                                <p class="text-xs text-brand-600">Precio: ${{ number_format($item->precio_unitario, 2) }}</p>
                                <p class="text-xs text-brand-500">Cantidad: {{ $item->cantidad }} | Talla: {{ optional($item->producto)->talla ?? 'N/A' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-brand-500 text-sm">No se encontraron artículos para este pedido.</p>
                    @endforelse
                </div>

                {{-- Columna Derecha: Resumen, Comprador, Dirección, Actualizar Estado --}}
                <div class="md:col-span-1 space-y-5">
                     <div class="bg-brand-50 p-4 rounded-lg border border-brand-100">
                        <h2 class="text-lg font-semibold text-brand-700 mb-2">Resumen Financiero</h2>
                         <div class="space-y-1 text-sm">
                             @php
                                 $subtotal = $pedido->detalles->sum(fn($item) => $item->precio_unitario * $item->cantidad);
                                 $costo_envio = max(0, $pedido->total - $subtotal);
                             @endphp
                             <div class="flex justify-between"><span class="text-brand-600">Subtotal:</span><span class="font-medium text-brand-700">${{ number_format($subtotal, 2) }}</span></div>
                             <div class="flex justify-between"><span class="text-brand-600">Envío:</span><span class="font-medium text-brand-700">${{ number_format($costo_envio, 2) }}</span></div>
                             <div class="flex justify-between font-bold border-t border-brand-200 pt-1 mt-1"><span class="text-brand-800">Total:</span><span class="text-brand-700">${{ number_format($pedido->total, 2) }}</span></div>
                         </div>
                    </div>
                     <div class="bg-brand-50 p-4 rounded-lg border border-brand-100">
                        <h2 class="text-lg font-semibold text-brand-700 mb-2">Datos del Comprador</h2>
                        {{-- Usamos optional() por si el usuario fue borrado --}}
                        <p class="text-sm text-brand-700 font-medium">{{ optional($pedido->usuario)->nombre_completo ?? 'Usuario eliminado' }}</p>
                        <p class="text-sm text-brand-600">{{ optional($pedido->usuario)->email ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-brand-50 p-4 rounded-lg border border-brand-100">
                        <h2 class="text-lg font-semibold text-brand-700 mb-2">Dirección de Envío</h2>
                        <div class="text-sm text-brand-600 space-y-1 whitespace-pre-line">
                            {{ $pedido->direccion_envio }}
                        </div>
                    </div>
                    <div class="bg-brand-50 p-4 rounded-lg border border-brand-100">
                        <h2 class="text-lg font-semibold text-brand-700 mb-3">Actualizar Estado</h2>
                        {{-- Formulario para actualizar estado, apunta a la ruta 'updateEstado' --}}
                         <form action="{{ route('admin.pedidos.updateEstado', $pedido) }}" method="POST" class="flex items-center space-x-3">
                             @csrf
                             @method('PUT')
                             <select name="nuevo_estado" class="flex-grow bg-white border-brand-200 rounded-lg px-3 py-1.5 text-sm focus:ring-brand-500 focus:border-brand-500">
                                 @foreach (['Procesando', 'Enviado', 'Entregado', 'Cancelado'] as $estado_opt)
                                    <option value="{{ $estado_opt }}" @selected($pedido->estado == $estado_opt)>
                                         {{ $estado_opt }}
                                     </option>
                                 @endforeach
                             </select>
                             <x-primary-button type="submit" class="!bg-brand-600 hover:!bg-brand-700 !text-sm !px-4 !py-1.5">
                                 Guardar
                             </x-primary-button>
                         </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
@endsection