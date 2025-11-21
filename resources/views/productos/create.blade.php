<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                {{ __('Subir Nueva Prenda') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <!-- Información importante -->
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-8">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-amber-800 text-lg">Importante</h3>
                                <p class="text-amber-700 mt-1">Tu prenda será revisada por nuestro equipo y estará visible en la tienda una vez aprobada. Esto puede tomar hasta 24 horas.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('mis-prendas.subir-prenda.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Información Básica -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Información Básica</h3>
                            
                            <!-- Nombre -->
                            <div class="mb-6">
                                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">Nombre de la prenda *</label>
                                <input type="text" name="nombre" id="nombre" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                       value="{{ old('nombre') }}"
                                       placeholder="Ej: Camiseta de algodón verde">
                                @error('nombre')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="mb-6">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">Descripción *</label>
                                <textarea name="descripcion" id="descripcion" rows="4" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                          placeholder="Describe tu prenda...">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Imagen -->
                            <div class="mb-6">
                                <label for="imagen" class="block text-sm font-medium text-gray-700 mb-2">Imagen de la prenda *</label>
                                <input type="file" name="imagen" id="imagen" accept="image/*" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                <p class="text-gray-500 text-sm mt-1">Formatos: JPEG, PNG, JPG, WEBP. Máx: 5MB</p>
                                @error('imagen')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Detalles de la Prenda -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Detalles de la Prenda</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Categoría -->
                                <div>
                                    <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">Categoría *</label>
                                    <select name="categoria_id" id="categoria_id" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                        <option value="">Selecciona una categoría</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                {{ $categoria->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categoria_id')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Talla -->
                                <div>
                                    <label for="talla" class="block text-sm font-medium text-gray-700 mb-2">Talla *</label>
                                    <input type="text" name="talla" id="talla" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                           value="{{ old('talla') }}"
                                           placeholder="Ej: M, 38, Única">
                                    @error('talla')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Estado -->
                                <div>
                                    <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                                    <select name="estado" id="estado" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                                        <option value="">Selecciona el estado</option>
                                        <option value="Nuevo" {{ old('estado') == 'Nuevo' ? 'selected' : '' }}>Nuevo</option>
                                        <option value="Como nuevo" {{ old('estado') == 'Como nuevo' ? 'selected' : '' }}>Como nuevo</option>
                                        <option value="Buen estado" {{ old('estado') == 'Buen estado' ? 'selected' : '' }}>Buen estado</option>
                                        <option value="Usado" {{ old('estado') == 'Usado' ? 'selected' : '' }}>Usado</option>
                                    </select>
                                    @error('estado')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Precios -->
                        <div class="mb-8">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Precios</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Precio Normal -->
                                <div>
                                    <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">Precio normal *</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                                        <input type="number" name="precio" id="precio" step="0.01" min="0.01" required
                                               class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                               value="{{ old('precio') }}"
                                               placeholder="0.00">
                                    </div>
                                    @error('precio')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Precio Oferta -->
                                <div>
                                    <label for="precio_oferta" class="block text-sm font-medium text-gray-700 mb-2">Precio oferta (opcional)</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                                        <input type="number" name="precio_oferta" id="precio_oferta" step="0.01" min="0.01"
                                               class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors"
                                               value="{{ old('precio_oferta') }}"
                                               placeholder="0.00">
                                    </div>
                                    <p class="text-gray-500 text-sm mt-1">Debe ser menor al precio normal</p>
                                    @error('precio_oferta')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Categorizacion Manual -->

                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                                </svg>
                                Tipo de Prenda
                            </label>
                            <select name="tipo_prenda" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                                <option value="">🤖 Dejar que la IA clasifique automáticamente</option>
                                <option value="superior">👕 Parte Superior (Camisetas, Blusas, Polos)</option>
                                <option value="inferior">👖 Parte Inferior (Pantalones, Faldas, Shorts)</option>
                                <option value="calzado">👟 Calzado (Zapatos, Zapatillas, Botas)</option>
                                <option value="accesorio">💎 Accesorio (Bolsos, Joyería, Cinturones)</option>
                                <option value="abrigo">🧥 Abrigo (Chaquetas, Abrigos, Sudaderas)</option>
                                <option value="vestido">👗 Vestido (Vestidos enteros)</option>
                                <option value="otros">📦 Otros</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-2">
                                💡 <strong>Consejo:</strong> Si dejas la selección automática, nuestra IA clasificará la prenda por su nombre para crear mejores outfits.
                            </p>
                        </div>

                        <!-- Botones -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('mis-prendas.index') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-600 transition-colors flex-1">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Subir Prenda
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>