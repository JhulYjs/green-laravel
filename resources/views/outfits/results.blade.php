<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tus Outfits - GreenCloset</title>

    {{-- Fonts y Styles --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0fdf4 100%);
        }
        .outfit-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        .outfit-card:hover {
            transform: translateY(-8px);
            border-color: #10b981;
            box-shadow: 0 25px 50px rgba(16, 185, 129, 0.15);
        }
        .product-image {
            transition: transform 0.3s ease;
        }
        .product-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="font-sans antialiased gradient-bg min-h-screen">
    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-12 px-4">
                <div class="inline-flex items-center bg-white px-6 py-3 rounded-2xl shadow-lg border border-emerald-100 mb-6">
                    <svg class="w-6 h-6 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <span class="text-lg font-bold text-emerald-600">Outfits Generados por IA</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 font-serif mb-4">
                    Tus Outfits Personalizados
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Combinaciones únicas creadas especialmente para ti
                </p>
            </div>

            {{-- Outfits Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8 px-4">
                @forelse($outfits['outfits'] ?? [] as $outfit)
                <div class="outfit-card rounded-2xl p-6 shadow-lg">
                    {{-- Outfit Header --}}
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 font-serif mb-2">{{ $outfit['nombre'] }}</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $outfit['descripcion'] }}</p>
                    </div>

                    {{-- Products Grid --}}
                    <div class="grid grid-cols-1 gap-4 mb-6">
                        @foreach($outfit['prendas_detalles'] as $producto)
                        <div class="bg-white rounded-xl p-4 border border-gray-200 hover:border-emerald-300 transition-all duration-200">
                            <div class="flex items-center space-x-4">
                                {{-- Product Image --}}
                                <div class="flex-shrink-0">
                                    @php
                                        $imageUrl = $producto->usuario_id !== null 
                                            ? asset('storage/' . $producto->imagen_url)
                                            : asset($producto->imagen_url);
                                    @endphp
                                    <img src="{{ $imageUrl }}" alt="{{ $producto->nombre }}" 
                                         class="w-16 h-16 object-cover rounded-lg product-image">
                                </div>
                                
                                {{-- Product Info --}}
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800 truncate">{{ $producto->nombre }}</h4>
                                    <p class="text-sm text-gray-600">Talla: {{ $producto->talla }}</p>
                                    <p class="text-lg font-bold text-emerald-600">S/{{ number_format($producto->precio_final, 2) }}</p>
                                </div>
                            </div>
                            
                            {{-- Action Buttons --}}
                            <div class="flex space-x-2 mt-3">
                                <a href="{{ route('producto.show', $producto) }}" 
                                   class="flex-1 bg-emerald-500 text-white text-center py-2 px-3 rounded-lg text-sm font-semibold hover:bg-emerald-600 transition-colors">
                                    Ver Detalles
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>               
                </div>
                @empty
                {{-- Empty State --}}
                <div class="col-span-full text-center py-12">
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-200 max-w-md mx-auto">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">No se pudieron generar outfits</h3>
                        <p class="text-gray-600 mb-6">Intenta con diferentes preferencias</p>
                        <a href="{{ route('outfits.generator') }}" 
                           class="bg-emerald-500 text-white py-3 px-6 rounded-xl font-semibold hover:bg-emerald-600 transition-colors inline-block">
                            Intentar Nuevamente
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            {{-- CTA Section --}}
            @if(!empty($outfits['outfits']))
            <div class="text-center mt-12 px-4">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-emerald-200 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">¿No te convencen estos outfits?</h3>
                    <p class="text-gray-600 mb-6">Nuestra IA puede crear combinaciones diferentes con tus preferencias</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('outfits.generator') }}" 
                           class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-3 px-8 rounded-xl font-semibold hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 transform hover:-translate-y-0.5">
                            Generar Nuevos Outfits
                        </a>
                        <a href="{{ route('coleccion') }}" 
                           class="bg-gray-100 text-gray-700 py-3 px-8 rounded-xl font-semibold hover:bg-gray-200 transition-colors">
                            Explorar Catálogo
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Footer --}}
    <x-footer />

    {{-- Cart Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add to cart functionality
            document.querySelectorAll('.add-to-cart-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const productData = {
                        id: this.dataset.id,
                        nombre: this.dataset.nombre,
                        precio: this.dataset.precio,
                        imagen: this.dataset.imagen,
                        estado: this.dataset.estado,
                        talla: this.dataset.talla
                    };
                    
                    // Aquí puedes agregar la lógica para añadir al carrito
                    console.log('Añadir al carrito:', productData);
                    
                    // Mostrar feedback visual
                    const originalText = this.innerHTML;
                    this.innerHTML = '✓ Añadido';
                    this.style.backgroundColor = '#10b981';
                    this.style.color = 'white';
                    
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.style.backgroundColor = '';
                        this.style.color = '';
                    }, 2000);
                });
            });
        });
    </script>
</body>
</html>