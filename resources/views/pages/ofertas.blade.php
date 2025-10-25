<x-app-layout>
    <x-slot name="header">
<<<<<<< HEAD
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-red-600 to-pink-600 bg-clip-text text-transparent">
                {{ __('Ofertas Especiales') }}
            </h2>
        </div>
=======
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ofertas Especiales') }}
        </h2>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
<<<<<<< HEAD
            {{-- Cabecera de Ofertas --}}
            <div class="bg-gradient-to-r from-red-50 via-pink-50 to-orange-50 rounded-2xl p-10 mb-12 border border-red-200 shadow-lg">
                 <div class="flex items-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-pink-500 rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
            {{-- Cabecera de Ofertas - Adaptada de ofertas.php --}}
            <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-lg p-8 mb-12 border border-red-200">
                 <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <div>
<<<<<<< HEAD
                        <div class="inline-flex items-center space-x-2 bg-red-100 px-4 py-2 rounded-full mb-2">
                            <span class="text-red-600">🔥</span>
                            <span class="text-sm font-bold text-red-700 uppercase tracking-wide">Ofertas Especiales</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-red-600 bg-clip-text text-transparent">
                            Últimas Oportunidades
                        </h1>
                    </div>
                </div>
                <p class="text-gray-600 text-lg max-w-2xl leading-relaxed">
                    Aprovecha nuestros precios especiales en prendas seleccionadas. Descuentos exclusivos por tiempo limitado.
                </p>
=======
                        <p class="text-sm uppercase tracking-wider text-red-600 font-bold">Ofertas Especiales</p>
                        <h1 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif mt-1">Últimas oportunidades</h1>
                    </div>
                </div>
                <p class="text-brand-600 mt-2 max-w-2xl">Aprovecha nuestros precios especiales en prendas seleccionadas.</p>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
            </div>

            {{-- Layout FLEX con Sidebar y Grid --}}
            <div class="flex flex-col lg:flex-row gap-8 mt-8">
<<<<<<< HEAD
                 {{-- Sidebar de Filtros --}}
                <aside class="w-full lg:w-80 flex-shrink-0">
                    <div class="bg-gradient-to-br from-white to-gray-50 p-6 rounded-2xl border border-gray-200 shadow-lg sticky top-24">
                        <h3 class="font-bold text-red-600 text-lg mb-6 flex items-center">
                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                           </svg>
                           FILTRAR OFERTAS
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Buscar ofertas</label>
                                <input type="text" id="search-input" name="busqueda" placeholder="Buscar..."
                                       class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Categoría</label>
                                <select name="categoria" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Todas las categorías</option>
                                    @foreach ($categorias ?? [] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Rango de Precio</label>
                                 <div class="grid grid-cols-2 gap-3">
                                     <input type="number" name="precio_min" placeholder="Mín $" 
                                            class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-3 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300" min="0" step="0.01">
                                     <input type="number" name="precio_max" placeholder="Máx $" 
                                            class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-3 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300" min="0" step="0.01">
                                </div>
                            </div>
                             <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Talla</label>
                                <select name="talla" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                     <option value="">Todas las tallas</option>
                                     <option value="XS">XS</option> <option value="S">S</option> <option value="M">M</option>
                                    <option value="L">L</option> <option value="XL">XL</option> <option value="Única">Única</option>
                                 </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Estado</label>
                                <select name="estado" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Todos los estados</option>
                                     <option value="Nuevo">Nuevo</option> <option value="Como nuevo">Como nuevo</option>
                                    <option value="Buen estado">Buen estado</option> <option value="Usado">Usado</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Ordenar por</label>
                                <select name="orden" class="filter-input w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-300">
                                    <option value="fecha_desc">Más recientes</option>
                                    <option value="precio_asc">Precio: menor a mayor</option>
                                    <option value="precio_desc">Precio: mayor a menor</option>
                                    <option value="descuento_desc">Mayor descuento</option>
                                </select>
                            </div>
                            <button id="clear-filters-button" class="w-full bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700 py-3 px-4 rounded-xl font-bold text-sm hover:from-gray-300 hover:to-gray-400 transition-all duration-300 transform hover:-translate-y-0.5 shadow-sm">
                                🔄 Limpiar Filtros
                            </button>
                        </div>
=======

                 {{-- Sidebar de Filtros (Igual que en welcome.blade.php, pero ajustado para ofertas) --}}
                <aside class="w-full lg:w-72 flex-shrink-0">
                    <div class="bg-white p-6 rounded-lg border border-brand-100 shadow-sm sticky top-24">
                        <h3 class="font-bold text-brand-700 text-lg mb-6 flex items-center text-red-600">
                           <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                           FILTRAR OFERTAS
                        </h3>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-brand-700 mb-2">Buscar ofertas</label>
                            <input type="text" id="search-input" name="busqueda" {{-- Añadido name --}} placeholder="Buscar..."
                                   class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-brand-700 mb-2">Categoría</label>
                            <select name="categoria" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                <option value="">Todas</option>
                                {{-- $categorias viene del ProductoController@ofertas --}}
                                @foreach ($categorias ?? [] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div class="mb-6">
                            <label class="block text-sm font-semibold text-brand-700 mb-2">Precio</label>
                             <div class="grid grid-cols-2 gap-3">
                                 <input type="number" name="precio_min" placeholder="Mín $" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent" min="0" step="0.01">
                                 <input type="number" name="precio_max" placeholder="Máx $" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent" min="0" step="0.01">
                            </div>
                        </div>
                         <div class="mb-6">
                            <label class="block text-sm font-semibold text-brand-700 mb-2">Talla</label>
                            <select name="talla" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                 <option value="">Todas</option>
                                 <option value="XS">XS</option> <option value="S">S</option> <option value="M">M</option>
                                <option value="L">L</option> <option value="XL">XL</option> <option value="Única">Única</option>
                             </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-brand-700 mb-2">Estado</label>
                            <select name="estado" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                <option value="">Todos</option>
                                 <option value="Nuevo">Nuevo</option> <option value="Como nuevo">Como nuevo</option>
                                <option value="Buen estado">Buen estado</option> <option value="Usado">Usado</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-semibold text-brand-700 mb-2">Ordenar por</label>
                            <select name="orden" class="filter-input w-full bg-brand-50 border border-brand-200 rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-transparent">
                                <option value="fecha_desc">Más recientes</option>
                                <option value="precio_asc">Precio: menor a mayor</option>
                                <option value="precio_desc">Precio: mayor a menor</option>
                                <option value="descuento_desc">Mayor descuento</option> {{-- Específico de ofertas --}}
                            </select>
                        </div>
                        <button id="clear-filters-button" class="w-full bg-brand-200 text-brand-700 py-2 px-4 rounded-lg font-semibold text-sm hover:bg-brand-300 transition-colors">
                            Limpiar Filtros
                        </button>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                    </div>
                </aside>

                {{-- Grid de Productos --}}
                <div class="flex-1">
<<<<<<< HEAD
                    <div class="bg-gradient-to-br from-white to-gray-50 overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                         <div class="p-8">
                             {{-- Contenedor para la rejilla --}}
                             <div id="product-grid-container">
=======
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                         <div class="p-6 text-gray-900">
                             {{-- Contenedor para la rejilla (para AJAX) --}}
                             <div id="product-grid-container">
                                 {{-- Incluimos la vista parcial del grid --}}
                                 {{-- La variable $productos viene del ProductoController@ofertas --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                                 @include('productos.partials.grid', ['productos' => $productos])
                             </div>
                         </div>
                    </div>
                </div>
<<<<<<< HEAD
            </div>
=======

            </div> {{-- Fin Layout Flex --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
        </div>
    </div>
</x-app-layout>