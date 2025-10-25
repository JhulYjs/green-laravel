<x-app-layout>
    <x-slot name="header">
<<<<<<< HEAD
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                {{ __('Editar Prenda') }}
            </h2>
        </div>
=======
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Prenda') }}
        </h2>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
<<<<<<< HEAD
            {{-- Mensaje de éxito/error --}}
            @if (session('status'))
                <div class="mb-6 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 rounded-2xl p-6 shadow-lg" role="alert">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('status') }}
                    </div>
=======
            {{-- Mensaje de éxito/error (Flash Message) --}}
            @if (session('status'))
                <div class="mb-6 bg-green-100 border border-green-200 text-sm text-green-700 rounded-md p-4" role="alert">
                    {{ session('status') }}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                </div>
            @endif
            
            {{-- Mostrar Errores de Validación --}}
            @if ($errors->any())
<<<<<<< HEAD
                <div class="mb-6 bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-700 rounded-2xl p-6 shadow-lg" role="alert">
                    <div class="flex items-center mb-3">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <p class="font-bold">¡Ups! Hubo algunos problemas:</p>
                    </div>
                    <ul class="mt-2 list-disc list-inside space-y-1">
=======
                <div class="mb-6 bg-red-100 border border-red-200 text-sm text-red-700 rounded-md p-4" role="alert">
                    <p class="font-bold">¡Ups! Hubo algunos problemas:</p>
                    <ul class="mt-2 list-disc list-inside">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

<<<<<<< HEAD
            <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-8 text-gray-900">
                    {{-- Header --}}
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center space-x-2 bg-emerald-100 px-6 py-3 rounded-full mb-4">
                            <span class="text-emerald-600">👕</span>
                            <span class="text-sm font-bold text-emerald-700 uppercase tracking-wider">MIS PRENDAS</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent">
                            Editar Prenda
                        </h1>
                        <p class="text-gray-600 mt-3 text-lg">Modifica los detalles de tu artículo.</p>
                    </div>

                    {{-- Formulario --}}
                    <form action="{{ route('mis-prendas.update', $prenda) }}" method="POST" class="mt-8 space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- Título --}}
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                            <x-input-label for="nombre" value="Título de la publicación" class="!text-base !font-bold !text-gray-700 mb-4" />
                            <x-text-input type="text" name="nombre" id="nombre" 
                                         class="w-full bg-gray-50 border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-emerald-500 transition-all duration-300" 
                                         :value="old('nombre', $prenda->nombre)" required />
                        </div>

                        {{-- Descripción --}}
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                             <x-input-label for="descripcion" value="Descripción" class="!text-base !font-bold !text-gray-700 mb-4" />
                             <textarea name="descripcion" id="descripcion" rows="6" 
                                      class="w-full bg-gray-50 border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-lg px-4 py-3 transition-all duration-300" 
                                      required>{{ old('descripcion', $prenda->descripcion) }}</textarea>
                        </div>

                        {{-- Precios y Talla --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                                <x-input-label for="precio" value="Precio (€)" class="!text-base !font-bold !text-gray-700 mb-4" />
                                <x-text-input type="number" name="precio" id="precio" 
                                             class="w-full bg-gray-50 border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-emerald-500 transition-all duration-300" 
                                             :value="old('precio', $prenda->precio)" step="0.01" min="0.01" required />
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                                <x-input-label for="precio_oferta" value="Precio Oferta (Opc.)" class="!text-base !font-bold !text-gray-700 mb-4" />
                                <x-text-input type="number" name="precio_oferta" id="precio_oferta" 
                                             class="w-full bg-gray-50 border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-emerald-500 transition-all duration-300" 
                                             :value="old('precio_oferta', $prenda->precio_oferta)" step="0.01" min="0.01" />
                                <p class="text-sm text-gray-500 mt-2">Dejar vacío o 0 si no hay oferta.</p>
                            </div>
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                                <x-input-label for="talla" value="Talla" class="!text-base !font-bold !text-gray-700 mb-4" />
                                <x-text-input type="text" name="talla" id="talla" 
                                             class="w-full bg-gray-50 border-gray-300 rounded-xl px-4 py-3 text-lg focus:ring-2 focus:ring-emerald-500 transition-all duration-300" 
                                             :value="old('talla', $prenda->talla)" required />
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                            </div>
                        </div>

                        {{-- Categoría y Estado --}}
<<<<<<< HEAD
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                                <x-input-label for="categoria_id" value="Categoría" class="!text-base !font-bold !text-gray-700 mb-4" />
                                <select name="categoria_id" id="categoria_id" 
                                        class="w-full bg-gray-50 border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-lg px-4 py-3 transition-all duration-300" required>
=======
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <x-input-label for="categoria_id" value="Categoría" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                {{-- Usamos <select> directamente --}}
                                <select name="categoria_id" id="categoria_id" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                    <option value="" disabled>Selecciona una categoría</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}" @selected(old('categoria_id', $prenda->categoria_id) == $cat->id)>
                                            {{ $cat->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
<<<<<<< HEAD
                            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                                <x-input-label for="estado" value="Estado de la prenda" class="!text-base !font-bold !text-gray-700 mb-4" />
                                <select name="estado" id="estado" 
                                        class="w-full bg-gray-50 border-gray-300 rounded-xl shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-lg px-4 py-3 transition-all duration-300" required>
=======
                            <div>
                                <x-input-label for="estado" value="Estado de la prenda" class="!text-sm !font-bold !text-brand-700 mb-2" />
                                <select name="estado" id="estado" class="w-full bg-brand-50 border-brand-200 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                    @foreach (['Nuevo', 'Como nuevo', 'Buen estado', 'Usado'] as $estado)
                                        <option value="{{ $estado }}" @selected(old('estado', $prenda->estado) == $estado)>
                                            {{ $estado }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Imagen Actual --}}
<<<<<<< HEAD
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                            <label class="block text-base font-bold text-gray-700 mb-4">Imagen Actual</label>
                            <div class="flex items-center space-x-6">
                                <img src="{{ asset($prenda->imagen_url) }}" alt="Imagen actual" class="w-32 h-32 object-cover rounded-2xl border-2 border-emerald-200 shadow-lg">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600">La edición de imagen no está disponible por ahora.</p>
                                    <p class="text-xs text-gray-500 mt-2">Para cambiar la imagen, contacta con soporte.</p>
                                </div>
                            </div>
                        </div>

                        {{-- Botones --}}
                        <div class="mt-8 border-t border-gray-200 pt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                            <x-primary-button type="submit" class="!bg-gradient-to-r !from-emerald-500 !to-teal-500 hover:!from-emerald-600 hover:!to-teal-600 !px-10 !py-4 !text-lg !font-bold !rounded-2xl transform hover:-translate-y-1 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Guardar Cambios
                            </x-primary-button>
                            <a href="{{ route('mis-prendas.index') }}" 
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 font-bold rounded-2xl border border-gray-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Cancelar
                            </a>
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>