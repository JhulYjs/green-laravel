@extends('layouts.admin')

@section('title', 'Editar Usuario #' . $usuario->id)

@section('content')
    <div class="max-w-2xl mx-auto">
        {{-- Botón Volver --}}
        <div class="mb-6">
            <a href="{{ route('admin.usuarios.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Volver a Usuarios
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg border border-brand-100 shadow-sm">
            <h2 class="text-xl font-semibold text-brand-800 mb-6">Editando Usuario #{{ $usuario->id }}</h2>

            {{-- Mensajes Flash de Éxito/Error --}}
            @if (session('status_success'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 p-3 rounded-lg text-sm" role="alert">
                    {{ session('status_success') }}
                </div>
            @elseif (session('status_error'))
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 p-3 rounded-lg text-sm" role="alert">
                    {{ session('status_error') }}
                </div>
            @endif
            
            {{-- Errores de Validación --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-200 text-sm text-red-700 rounded-md p-4" role="alert">
                    <p class="font-bold">¡Ups! Hubo algunos problemas:</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nombre Completo --}}
                <div class="mb-4">
                    <x-input-label for="nombre_completo" value="Nombre completo" class="!text-sm !font-bold !text-brand-700 mb-2" />
                    <x-text-input type="text" name="nombre_completo" id="nombre_completo" class="w-full bg-brand-50 border-brand-200" :value="old('nombre_completo', $usuario->nombre_completo)" required />
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <x-input-label for="email" value="Email" class="!text-sm !font-bold !text-brand-700 mb-2" />
                    <x-text-input type="email" name="email" id="email" class="w-full bg-brand-50 border-brand-200" :value="old('email', $usuario->email)" required />
                </div>

                {{-- Rol --}}
                <div class="mb-6">
                    <x-input-label for="rol" value="Rol" class="!text-sm !font-bold !text-brand-700 mb-2" />
                    <select name="rol" id="rol" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        <option value="usuario" @selected(old('rol', $usuario->rol) == 'usuario')>Usuario</option>
                        <option value="admin" @selected(old('rol', $usuario->rol) == 'admin')>Administrador</option>
                    </select>
                    {{-- Advertencia si se edita a sí mismo --}}
                    @if(Auth::id() == $usuario->id)
                         <p class="text-xs text-amber-600 mt-1">Advertencia: Cambiar tu propio rol podría restringir tu acceso al panel.</p>
                    @endif
                </div>

                <div class="mt-8 border-t border-brand-100 pt-6">
                    <x-primary-button type="submit" class="!bg-brand-600 hover:!bg-brand-700 !text-sm !px-8">
                        Guardar Cambios
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
@endsection