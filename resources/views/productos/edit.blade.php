<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Prenda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje de éxito/error (Flash Message) --}}
            @if (session('status'))
                <div class="mb-6 bg-green-100 border border-green-200 text-sm text-green-700 rounded-md p-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
            {{-- Mostrar Errores de Validación --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-200 text-sm text-red-700 rounded-md p-4" role="alert">
                    <p class="font-bold">¡Ups! Hubo algunos problemas:</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 border border-gray-100">
                    <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">Mis Prendas</p>
                    <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Editar Prenda</h1>
                    <p class="text-brand-600 mt-2">Modifica los detalles de tu artículo.</p>

                    {{-- Formulario apunta a la ruta 'update', usando método PUT --}}
                    <form action="{{ route('mis-prendas.update', $prenda) }}" method="POST" class="mt-8">
                        @csrf {{-- Token CSRF --}}
                        @method('PUT') {{-- Especifica el método HTTP PUT --}}

                        {{-- Título --}}
                        <div class="mb-6">
                            <x-input-label for="nombre" value="Título de la publicación" class="!text-sm !font-bold !text-brand-700 mb-2" />
                            <x-text-input type="text" name="nombre" id="nombre" class="w-full bg-brand-50 border-brand-200" :value="old('nombre', $prenda->nombre)" required />
                        </div>

                        {{-- Descripción --}}
                        <div class="mb-6">
                             <x-input-label for="descripcion" value="Descripción" class="!text-sm !font-bold !text-brand-700 mb-2" />
                             {{-- Usamos <textarea> directamente porque no hay un componente Blade estándar simple --}}
                             <textarea name="descripcion" id="descripcion" rows="5" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>{{ old('descripcion', $prenda->descripcion) }}</textarea>
                        </div>

                        {{-- Precios y Talla --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <x-input-label for="precio" value="Precio (€)" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                <x-text-input type="number" name="precio" id="precio" class="w-full bg-brand-50 border-brand-200" :value="old('precio', $prenda->precio)" step="0.01" min="0.01" required />
                            </div>
                            <div>
                                <x-input-label for="precio_oferta" value="Precio Oferta (Opc.)" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                <x-text-input type="number" name="precio_oferta" id="precio_oferta" class="w-full bg-brand-50 border-brand-200" :value="old('precio_oferta', $prenda->precio_oferta)" step="0.01" min="0.01" />
                                <p class="text-xs text-gray-400 mt-1">Dejar vacío o 0 si no hay oferta.</p>
                            </div>
                            <div>
                                <x-input-label for="talla" value="Talla" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                <x-text-input type="text" name="talla" id="talla" class="w-full bg-brand-50 border-brand-200" :value="old('talla', $prenda->talla)" required />
                            </div>
                        </div>

                        {{-- Categoría y Estado --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="categoria_id" value="Categoría" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                {{-- Usamos <select> directamente --}}
                                <select name="categoria_id" id="categoria_id" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                                    <option value="" disabled>Selecciona una categoría</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('categoria_id', $prenda->categoria_id) == $cat->id)>
                                            {{ $cat->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="estado" value="Estado de la prenda" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                <select name="estado" id="estado" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                                    @foreach (['Nuevo', 'Como nuevo', 'Buen estado', 'Usado'] as $estado)
                                        <option value="{{ $estado }}" @selected(old('estado', $prenda->estado) == $estado)>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Imagen Actual --}}
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-brand-700 mb-2">Imagen Actual</label>
                            <img src="{{ asset($prenda->imagen_url) }}" alt="Imagen actual" class="w-24 h-auto rounded-lg border">
                            <p class="text-xs text-gray-400 mt-1">La edición de imagen no está disponible por ahora.</p>
                        </div>

                        {{-- Botones --}}
                        <div class="mt-8 border-t border-gray-100 pt-6 flex justify-between items-center">
                            <x-primary-button type="submit" class="!bg-brand-500 hover:!bg-brand-600 !text-sm !px-8">
                                Guardar Cambios
                            </x-primary-button>
                            <a href="{{ route('mis-prendas.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>