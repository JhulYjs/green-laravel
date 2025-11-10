@extends('layouts.admin')

@section('title', 'Editar Producto #' . $producto->id)

@section('content')
    <div class="max-w-4xl mx-auto">
        {{-- Botón Volver --}}
        <div class="mb-6">
            <a href="{{ route('admin.productos.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Volver a Productos
            </a>
        </div>

        <div class="bg-white p-8 rounded-lg border border-brand-100 shadow-sm">
            <h2 class="text-xl font-semibold text-brand-800 mb-6">Editando Producto #{{ $producto->id }}</h2>

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

            <form action="{{ route('admin.productos.update', $producto) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Título --}}
                <div class="mb-6">
                    <x-input-label for="nombre" value="Título" class="!text-sm !font-bold !text-brand-700 mb-2" />
                    <x-text-input type="text" name="nombre" id="nombre" class="w-full bg-brand-50 border-brand-200" :value="old('nombre', $producto->nombre)" required />
                </div>

                {{-- Descripción --}}
                <div class="mb-6">
                     <x-input-label for="descripcion" value="Descripción" class="!text-sm !font-bold !text-brand-700 mb-2" />
                     <textarea name="descripcion" id="descripcion" rows="5" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                {{-- Precios y Talla --}}
                 <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <x-input-label for="precio" value="Precio (€)" class="!text-sm !font-bold !text-brand-700 mb-2" />
                        <x-text-input type="number" name="precio" id="precio" class="w-full bg-brand-50 border-brand-200" :value="old('precio', $producto->precio)" step="0.01" min="0.01" required />
                    </div>
                     <div>
                        <x-input-label for="precio_oferta" value="Precio Oferta (Opc.)" class="!text-sm !font-bold !text-brand-700 mb-2" />
                        <x-text-input type="number" name="precio_oferta" id="precio_oferta" class="w-full bg-brand-50 border-brand-200" :value="old('precio_oferta', $producto->precio_oferta)" step="0.01" min="0.01" />
                        <p class="text-xs text-brand-400 mt-1">Vacío o 0 si no hay.</p>
                    </div>
                    <div>
                        <x-input-label for="talla" value="Talla" class="!text-sm !font-bold !text-brand-700 mb-2" />
                        <x-text-input type="text" name="talla" id="talla" class="w-full bg-brand-50 border-brand-200" :value="old('talla', $producto->talla)" required />
                    </div>
                </div>

                {{-- Categoría y Estado --}}
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-input-label for="categoria_id" value="Categoría" class="!text-sm !font-bold !text-brand-700 mb-2" />
                        <select name="categoria_id" id="categoria_id" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                            <option value="" disabled>Selecciona...</option>
                            @foreach ($categorias as $cat)
                                <option value="{{ $cat->id }}" @selected(old('categoria_id', $producto->categoria_id) == $cat->id)>
                                    {{ $cat->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="estado" value="Estado" class="!text-sm !font-bold !text-brand-700 mb-2" />
                        <select name="estado" id="estado" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                            @foreach (['Nuevo', 'Como nuevo', 'Buen estado', 'Usado'] as $estado)
                                <option value="{{ $estado }}" @selected(old('estado', $producto->estado) == $estado)>
                                    {{ $estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Imagen Actual --}}
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-brand-700 mb-2">Imagen Actual</h3>
                    
                    {{-- Imagen Actual --}}
                    <div class="mb-6">
                        <h3 class="text-sm font-bold text-brand-700 mb-2">Imagen Actual</h3>

                        @php
                            $imagePath = $producto->imagen_url ?? '';

                            // Asegurar que no empiece con una barra
                            $imagePath = ltrim($imagePath, '/');

                            // Determinar la URL final
                            if (file_exists(public_path($imagePath))) {
                                // Si el archivo existe en /public/uploads o similar
                                $finalUrl = asset($imagePath);
                            } elseif (file_exists(storage_path('app/public/' . $imagePath))) {
                                // Si existe en /storage/app/public/
                                $finalUrl = asset('storage/' . $imagePath);
                            } else {
                                // Imagen por defecto
                                $finalUrl = asset('images/placeholder.png');
                            }
                        @endphp

                        {{-- Mostrar solo una imagen válida --}}
                        <img src="{{ $finalUrl }}" 
                            alt="{{ $producto->nombre }}" 
                            class="w-48 h-auto rounded-lg border shadow-sm">
                    </div>

                    <div class="mt-8 border-t border-brand-100 pt-6">
                        <x-primary-button type="submit" class="!w-auto !bg-brand-600 hover:!bg-brand-700 !text-sm !px-8">
                            Guardar Cambios
                        </x-primary-button>
                    </div>
            </form>
        </div>
    </div>
@endsection