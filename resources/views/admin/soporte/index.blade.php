@extends('layouts.admin')

@section('title', 'Mensajes de Soporte')

@section('content')
    <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
        <h2 class="text-xl font-semibold text-brand-800 mb-4">Mensajes de Soporte Recibidos</h2>

        {{-- Mensajes Flash (si añadiéramos acciones como 'marcar como leído') --}}
        {{-- @if (session('status_success')) ... @endif --}}

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-brand-100">
                <thead class="bg-brand-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Mensaje</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Estado</th> {{-- Para 'leido' --}}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-brand-100">
                    @forelse ($mensajes as $mensaje)
                        <tr>
                            <td class="px-6 py-4 text-sm text-brand-900">{{ $mensaje->id }}</td>
                            <td class="px-6 py-4 text-sm text-brand-500 whitespace-nowrap">{{ $mensaje->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700">{{ $mensaje->nombre_completo }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700">{{ $mensaje->email }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700 max-w-md whitespace-normal break-words">{{ $mensaje->mensaje }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if ($mensaje->leido)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Leído</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pendiente</span>
                                @endif
                            </td>
                            {{-- Aquí podríamos añadir acciones (ej. Marcar como leído, Eliminar) --}}
                            {{-- <td class="px-6 py-4 text-sm font-medium">...</td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-brand-500">No se han recibido mensajes de soporte.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
             {{-- Si usaste paginación en el controlador --}}
            {{-- <div class="mt-4">
                {{ $mensajes->links() }}
            </div> --}}
        </div>
    </div>
@endsection