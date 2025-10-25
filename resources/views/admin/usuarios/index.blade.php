{{-- Extiende el layout admin.blade.php --}}
@extends('layouts.admin')

{{-- Define el título de la página --}}
@section('title', 'Gestión de Usuarios')

{{-- Define el contenido principal --}}
@section('content')
    <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm">
        <h2 class="text-xl font-semibold text-brand-800 mb-4">Listado de Usuarios</h2>

        {{-- Mostrar mensajes flash de éxito/error (para futuras acciones como eliminar/editar) --}}
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Rol</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Registrado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-brand-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-brand-100">
                    {{-- Usamos @forelse para manejar el caso de tabla vacía --}}
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td class="px-6 py-4 text-sm text-brand-900">{{ $usuario->id }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700">{{ $usuario->nombre_completo }}</td>
                            <td class="px-6 py-4 text-sm text-brand-700">{{ $usuario->email }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if ($usuario->rol == 'admin')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-brand-200 text-brand-800">Admin</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Usuario</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-brand-500">{{ $usuario->fecha_registro->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm font-medium">
                                {{-- Enlace para Editar --}}
                                <a href="{{ route('admin.usuarios.edit', $usuario) }}" 
                                   class="text-brand-600 hover:text-brand-900 mr-3"> Editar
                                </a>
                                {{-- Formulario para Eliminar --}}
                                <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este usuario? Esta acción no se puede deshacer.');">
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
                            <td colspan="6" class="px-6 py-4 text-center text-brand-500">No se encontraron usuarios.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- Si usaste paginación en el controlador, descomenta esto para mostrar los enlaces --}}
            {{-- <div class="mt-4">
                {{ $usuarios->links() }}
            </div> --}}
        </div>
    </div>
@endsection