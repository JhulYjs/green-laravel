<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>GreenCloset - Colección</title> {{-- Título actualizado --}}

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        {{-- Scripts y CSS (Vite) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- Token CSRF para AJAX --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Configuración de Tailwind (para que funcionen las clases 'brand-') --}}
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            'sans': ['Figtree', 'Inter', 'sans-serif'],
                            'serif': ['Playfair Display', 'serif']
                        },
                        colors: {
                            'brand': {
                                '50': '#f4f6f3', '100': '#e5e9e2', '200': '#cbd3c7', '300': '#94a68e',
                                '400': '#7c9176', '500': '#5c7356', '600': '#455a41', '700': '#374834',
                                '800': '#2d3a2b', '900': '#253024', '950': '#141a14'
                            }
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-brand-50 text-brand-800 flex flex-col min-h-screen">
        <div class="flex-grow"> {{-- Contenedor para empujar footer hacia abajo --}}

            {{-- Incluimos la barra de navegación --}}
            @include('layouts.navigation')

            <main>
                {{-- Contenido de la Colección --}}
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                        {{-- Título RESPONSIVE --}}
                        <div class="text-center mb-8 sm:mb-12 px-4 sm:px-0">
                            <div class="inline-flex items-center bg-gradient-to-r from-emerald-50 to-teal-50 px-4 py-2 sm:px-6 sm:py-3 rounded-xl sm:rounded-2xl mb-3 sm:mb-4 border border-emerald-100">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"/>
                                </svg>
                                <span class="text-xs sm:text-sm uppercase tracking-wider text-emerald-600 font-semibold">Moda Circular</span>
                            </div>
                            <h1 class="text-2xl sm:text-4xl md:text-5xl font-bold text-gray-800 font-serif mt-2 bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Nuestra Colección</h1>
                            <p class="text-gray-600 mt-3 sm:mt-4 max-w-2xl mx-auto text-sm sm:text-lg leading-relaxed px-2">Descubre prendas únicas con historia y estilo sostenible</p>
                        </div>

                        {{-- Layout FLEX con Sidebar y Grid --}}
                        <div class="flex flex-col lg:flex-row gap-8 mt-8">

                            {{-- Sidebar de Filtros MEJORADO --}}
                            <aside class="w-full lg:w-80 flex-shrink-0">
                                  {{-- Botón para mostrar/ocultar filtros en móviles --}}
                                <div class="lg:hidden mb-4">
                                    <button id="filters-toggle" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 font-semibold text-gray-700 flex items-center justify-center shadow-sm hover:shadow-md transition-all">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                                        </svg>
                                        Mostrar/Ocultar Filtros
                                    </button>
                                </div> 
                            
                                    {{-- Contenedor de filtros --}}
                                    <div id="filters-container" class="bg-white p-6 rounded-2xl border border-gray-100 shadow-lg sticky top-24 hidden lg:block">                                        
                                    {{-- Header de filtros --}}
                                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
                                            <h3 class="font-bold text-xl text-gray-800">Filtros</h3>
                                            <div class="w-8 h-8 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center">
                                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                                                </svg>
                                            </div>
                                        </div>

                                        {{-- Búsqueda --}}
                                        <div class="mb-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                                Buscar prendas
                                            </label>
                                            <div class="relative">
                                                <input type="text" id="search-input" name="busqueda" placeholder="¿Qué estás buscando?"
                                                    class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 pl-10 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                </svg>
                                            </div>
                                        </div>

                                        {{-- Categoría --}}
                                        <div class="mb-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                                Categoría
                                            </label>
                                            <select name="categoria" class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                                                <option value="">Todas las categorías</option>
                                                @foreach ($categorias ?? [] as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Precio --}}
                                        <div class="mb-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                </svg>
                                                Rango de precio
                                            </label>
                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="relative">
                                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">S/</span>
                                                    <input type="number" name="precio_min" placeholder="Mín"
                                                        class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 pl-8 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200" min="0" step="0.01">
                                                </div>
                                                <div class="relative">
                                                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 text-sm">S/</span>
                                                    <input type="number" name="precio_max" placeholder="Máx"
                                                        class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-3 pl-8 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200" min="0" step="0.01">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Talla --}}
                                        <div class="mb-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                Talla
                                            </label>
                                            <select name="talla" class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                                                <option value="">Todas las tallas</option>
                                                <option value="XS">XS</option>
                                                <option value="S">S</option>
                                                <option value="M">M</option>
                                                <option value="L">L</option>
                                                <option value="XL">XL</option>
                                                <option value="Única">Única</option>
                                            </select>
                                        </div>

                                        {{-- Estado --}}
                                        <div class="mb-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Estado
                                            </label>
                                            <select name="estado" class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                                                <option value="">Todos los estados</option>
                                                <option value="Nuevo">Nuevo</option>
                                                <option value="Como nuevo">Como nuevo</option>
                                                <option value="Buen estado">Buen estado</option>
                                                <option value="Usado">Usado</option>
                                            </select>
                                        </div>

                                        {{-- Ordenar --}}
                                        <div class="mb-6">
                                            <label class="block text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"/>
                                                </svg>
                                                Ordenar por
                                            </label>
                                            <select name="orden" class="filter-input w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                                                <option value="fecha_desc">Más recientes</option>
                                                <option value="precio_asc">Precio: menor a mayor</option>
                                                <option value="precio_desc">Precio: mayor a menor</option>
                                                <option value="nombre_asc">Nombre A-Z</option>
                                            </select>
                                        </div>

                                        {{-- Botón limpiar --}}
                                        <button id="clear-filters-button" class="w-full bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-4 rounded-xl font-semibold text-sm hover:from-gray-200 hover:to-gray-300 transition-all duration-300 transform hover:-translate-y-0.5 shadow-md hover:shadow-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                            </svg>
                                            Limpiar Filtros
                                        </button>
                                        
                                        {{-- Botón Generar Outfits --}}
                                        <div class="mt-6 pt-6 border-t border-gray-200">
                                            <a href="{{ route('outfits.generator') }}" 
                                            class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-4 px-4 rounded-xl font-bold text-lg hover:from-purple-600 hover:to-pink-600 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center">
                                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                                </svg>
                                                Crear Outfits con IA
                                            </a>
                                            <p class="text-xs text-gray-500 text-center mt-2">
                                                Nuestra IA creará combinaciones únicas para ti
                                            </p>
                                        </div>


                                    </div>

                                    
                            </aside>

                            {{-- Grid de Productos MEJORADO --}}
                            <div class="flex-1">
                                <div class="bg-transparent">
                                    <div class="text-gray-900">

                                        {{-- CARRUSEL LO MÁS NUEVO - AGREGAR ESTO --}}
                                        @php
                                            $nuevasPrendas = App\Models\Producto::aprobados()
                                                ->orderBy('fecha_aprobacion', 'desc')
                                                ->take(4)
                                                ->get();
                                        @endphp

                                        @if($nuevasPrendas->count() > 0)
                                        <div class="mb-8">
                                            <div class="flex items-center justify-between mb-6">
                                                <div>
                                                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                                        <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                        </svg>
                                                        Lo Más Nuevo
                                                    </h2>
                                                    <p class="text-gray-600 text-sm mt-1">Últimas prendas aprobadas</p>
                                                </div>
                                                <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-medium">
                                                    Nuevo
                                                </span>
                                            </div>

                                            {{-- Carrusel Simple CSS --}}
                                            <style>
                                                .simple-carousel {
                                                    position: relative;
                                                    width: 100%;
                                                    height: 500px;
                                                    overflow: hidden;
                                                    border-radius: 16px;
                                                    box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
                                                }
                                                .carousel-track {
                                                    display: flex;
                                                    transition: transform 0.5s ease-in-out;
                                                    height: 100%;
                                                }
                                                .carousel-slide {
                                                    min-width: 100%;
                                                    height: 100%;
                                                    position: relative;
                                                }
                                                /* SOLO IMÁGENES DEL CARRUSEL - CORREGIDO */
                                                #carouselTrack .carousel-slide img {
                                                    width: 100%;
                                                    height: 100%;
                                                    object-fit: cover;
                                                    object-position: center;
                                                    display: block;
                                                }
                                                .slide-info {
                                                    position: absolute;
                                                    bottom: 0;
                                                    left: 0;
                                                    right: 0;
                                                    background: linear-gradient(transparent, rgba(0,0,0,0.8));
                                                    color: white;
                                                    padding: 30px 20px 20px;
                                                }
                                                .carousel-btn {
                                                    position: absolute;
                                                    top: 50%;
                                                    transform: translateY(-50%);
                                                    background: rgba(255,255,255,0.9);
                                                    border: none;
                                                    width: 50px;
                                                    height: 50px;
                                                    border-radius: 50%;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                    cursor: pointer;
                                                    font-size: 20px;
                                                    font-weight: bold;
                                                    color: #059669;
                                                    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                                                    transition: all 0.3s ease;
                                                    z-index: 10;
                                                }
                                                .carousel-btn:hover {
                                                    background: white;
                                                    transform: translateY(-50%) scale(1.1);
                                                }
                                                .carousel-prev { left: 20px; }
                                                .carousel-next { right: 20px; }
                                                .carousel-dots {
                                                    position: absolute;
                                                    bottom: 20px;
                                                    left: 50%;
                                                    transform: translateX(-50%);
                                                    display: flex;
                                                    gap: 10px;
                                                    z-index: 10;
                                                }
                                                .carousel-dot {
                                                    width: 12px;
                                                    height: 12px;
                                                    border-radius: 50%;
                                                    background: rgba(255,255,255,0.6);
                                                    cursor: pointer;
                                                    transition: all 0.3s ease;
                                                    border: 2px solid transparent;
                                                }
                                                .carousel-dot.active {
                                                    background: white;
                                                    transform: scale(1.2);
                                                    border-color: #059669;
                                                }
                                            </style>

                                            <div class="simple-carousel">
                                                <div class="carousel-track" id="carouselTrack">
                                                    @foreach($nuevasPrendas as $prenda)
                                                    <div class="carousel-slide">
                                                       @php
                                                            $imageUrl = \Illuminate\Support\Str::startsWith($prenda->imagen_url, 'http') 
                                                            ? $prenda->imagen_url 
                                                            : asset('storage/' . $prenda->imagen_url);
                                                        @endphp
                                                                                                        <img src="{{ $imageUrl }}" alt="{{ $prenda->nombre }}">
                                                        <div class="slide-info">
                                                            <h3 class="text-white font-bold text-xl mb-2">{{ $prenda->nombre }}</h3>
                                                            <p class="text-white text-lg mb-3">${{ number_format($prenda->precio_final, 2) }}</p>
                                                            <div class="flex items-center gap-4 mb-3">
                                                                <span class="text-white">📏 {{ $prenda->talla }}</span>
                                                                <span class="text-white">⭐ {{ $prenda->estado }}</span>
                                                                @if($prenda->precio_oferta)
                                                                <span class="text-emerald-300">🔥 Oferta Especial</span>
                                                                @endif
                                                            </div>
                                                            <a href="{{ route('producto.show', $prenda) }}" 
                                                               class="inline-flex items-center px-6 py-3 bg-emerald-500 text-white font-semibold rounded-lg hover:bg-emerald-600 transition-all duration-300 transform hover:scale-105">
                                                                Ver Detalles Completos
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-btn carousel-prev" onclick="prevSlide()">‹</button>
                                                <button class="carousel-btn carousel-next" onclick="nextSlide()">›</button>
                                                <div class="carousel-dots" id="carouselDots">
                                                    @foreach($nuevasPrendas as $key => $prenda)
                                                    <div class="carousel-dot {{ $key === 0 ? 'active' : '' }}" onclick="goToSlide({{ $key }})"></div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <script>
                                                let currentSlide = 0;
                                                const totalSlides = {{ $nuevasPrendas->count() }};
                                                const track = document.getElementById('carouselTrack');
                                                const dots = document.querySelectorAll('.carousel-dot');

                                                function updateCarousel() {
                                                    track.style.transform = `translateX(-${currentSlide * 100}%)`;
                                                    dots.forEach((dot, index) => {
                                                        dot.classList.toggle('active', index === currentSlide);
                                                    });
                                                }

                                                function nextSlide() {
                                                    currentSlide = (currentSlide + 1) % totalSlides;
                                                    updateCarousel();
                                                }

                                                function prevSlide() {
                                                    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                                                    updateCarousel();
                                                }

                                                function goToSlide(slideIndex) {
                                                    currentSlide = slideIndex;
                                                    updateCarousel();
                                                }

                                                // Auto avanzar cada 5 segundos
                                                setInterval(nextSlide, 5000);
                                            </script>
                                        </div>
                                        @endif

                                        {{-- Contenedor para la rejilla --}}
                                        <div id="product-grid-container">
                                            @include('productos.partials.grid', ['productos' => $productos])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            
                        
                        {{-- Fin Layout Flex --}}
                        
                    </div>
                </div>
            </main>
        </div> {{-- Fin flex-grow --}}

        {{-- Incluimos el Footer --}}
        <x-footer />

        {{-- HTML Oculto para Carrito --}}
        <div id="cart-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm z-[100] hidden opacity-0 transition-opacity duration-300"></div>
        <div id="cart-panel"
             class="fixed top-0 right-0 h-full w-full max-w-md bg-white z-[101] transform translate-x-full transition-transform duration-300 shadow-2xl flex flex-col">
             <div class="flex items-center justify-center h-full"><p class="text-gray-500">Cargando carrito...</p></div>
        </div>

        {{-- HTML Oculto para Checkout Modal --}}
        <div id="checkout-overlay"
             class="fixed inset-0 bg-gray-900 bg-opacity-70 backdrop-blur-md z-[110] hidden items-center justify-center p-4">
            <div id="checkout-panel"
                 class="bg-white rounded-lg w-full max-w-4xl transform transition-all duration-300 scale-95 opacity-0 shadow-xl max-h-[90vh] overflow-hidden border border-gray-200 flex flex-col">
                {{-- Encabezado --}}
                <div class="flex items-center justify-between p-6 border-b border-gray-100 bg-gray-50">
                    <div><h2 class="text-2xl font-semibold font-serif text-gray-800">Finalizar Compra</h2><p class="text-gray-600 mt-1 text-sm">Completa tu información</p></div>
                    <button id="close-checkout-button" class="p-2 text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                 {{-- Contenido Scrollable --}}
                <div class="p-6 overflow-y-auto flex-grow">
                     <form id="checkout-form" class="space-y-8">
                        @csrf
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                             {{-- Columna Izquierda: Formulario Envío --}}
                            <div class="space-y-6 bg-gray-50 p-6 rounded-lg border border-gray-200">
                                 <h3 class="font-semibold text-gray-700 text-lg mb-4">Información de Envío</h3>
                                <div class="space-y-4">
                                    <div><x-input-label for="direccion_modal_wc" value="Dirección Completa" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="text" name="direccion" id="direccion_modal_wc" class="w-full text-sm" placeholder="Calle, número, colonia" required /></div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div><x-input-label for="ciudad_modal_wc" value="Ciudad" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="text" name="ciudad" id="ciudad_modal_wc" class="w-full text-sm" placeholder="Tu ciudad" required /></div>
                                        <div><x-input-label for="cp_modal_wc" value="Código Postal" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="text" name="cp" id="cp_modal_wc" class="w-full text-sm" placeholder="CP" required /></div>
                                    </div>
                                     <div><x-input-label for="telefono_modal_wc" value="Teléfono" class="mb-1 text-sm !font-semibold !text-gray-600" /><x-text-input type="tel" name="telefono" id="telefono_modal_wc" class="w-full text-sm" placeholder="+XX XXX XXX XXX" required /></div>
                                </div>
                            </div>
                            {{-- Columna Derecha: Resumen --}}
                             <div class="space-y-6">
                                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                                    <h3 class="font-semibold text-gray-700 text-lg mb-4">Resumen</h3>
                                     <div id="checkout-summary-items" class="space-y-2 mb-4 max-h-40 overflow-y-auto border-b border-gray-200 pb-3"><p class="text-sm text-gray-500 text-center py-4">Cargando...</p></div>
                                    <div class="space-y-1 border-t border-gray-200 pt-3 text-sm">
                                        <div class="flex justify-between"><span class="text-gray-600">Subtotal:</span><span id="checkout-summary-subtotal" class="font-semibold text-gray-700">S/0.00</span></div>
                                        <div class="flex justify-between"><span class="text-gray-600">Envío:</span><span id="checkout-summary-shipping" class="font-semibold text-gray-700">S/10.00</span></div>
                                        <div class="flex justify-between text-base font-bold border-t border-gray-200 pt-2 mt-2"><span class="text-gray-800">Total:</span><span id="checkout-summary-total" class="text-brand-700 text-lg">S/0.00</span></div>
                                    </div>
                                </div>
                                <x-primary-button type="submit" class="w-full justify-center !py-3 !text-base !font-bold">Confirmar Pedido</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
    <script>
// Toggle de filtros en móviles
document.addEventListener('DOMContentLoaded', function() {
    const filtersToggle = document.getElementById('filters-toggle');
    const filtersContainer = document.getElementById('filters-container');
    
    if (filtersToggle && filtersContainer) {
        filtersToggle.addEventListener('click', function() {
            filtersContainer.classList.toggle('hidden');
            filtersContainer.classList.toggle('block');
            
            // Cambiar icono/texto
            const icon = filtersToggle.querySelector('svg');
            if (filtersContainer.classList.contains('hidden')) {
                filtersToggle.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"/>
                    </svg>
                    Mostrar Filtros
                `;
            } else {
                filtersToggle.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Ocultar Filtros
                `;
            }
        });
    }
});
</script>
</html>
<!-- Cambio de estilos por Joha -->
