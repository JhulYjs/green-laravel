<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generador de Outfits - GreenCloset</title>

    {{-- Fonts y Styles --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 50%, #f0fdf4 100%);
        }
        .outfit-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .outfit-card:hover {
            transform: translateY(-5px);
            border-color: #10b981;
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
        }
        .preference-chip {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
    </style>
</head>
<body class="font-sans antialiased gradient-bg min-h-screen">
    {{-- Navigation --}}
    @include('layouts.navigation')

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            {{-- Header --}}
            <div class="text-center mb-12 px-4">
                <div class="inline-flex items-center bg-white px-6 py-3 rounded-2xl shadow-lg border border-emerald-100 mb-6">
                    <svg class="w-6 h-6 text-emerald-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <span class="text-lg font-bold text-emerald-600">IA + Moda Sostenible</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 font-serif mb-4">
                    Creador de Outfits
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Nuestra IA analizará tu estilo y creará outfits únicos con prendas sostenibles
                </p>
            </div>

            {{-- Generator Form --}}
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                <form id="outfit-generator-form" action="{{ route('outfits.process') }}" method="POST" class="p-8">
                    @csrf

                    {{-- Estilo --}}
                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                            ¿Qué estilo buscas?
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['Casual', 'Deportivo', 'Elegante', 'Bohemio', 'Vintage', 'Minimalista', 'Urbano', 'Romántico'] as $estilo)
                            <label class="relative">
                                <input type="radio" name="estilo" value="{{ $estilo }}" class="hidden peer" {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-full p-4 text-center border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 hover:border-emerald-300">
                                    <span class="font-semibold">{{ $estilo }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Ocasión --}}
                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            ¿Para qué ocasión?
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['Diario', 'Trabajo', 'Fiesta', 'Cita', 'Deporte', 'Viaje', 'Evento Formal', 'Relax'] as $ocasion)
                            <label class="relative">
                                <input type="radio" name="ocasion" value="{{ $ocasion }}" class="hidden peer" {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-full p-4 text-center border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 hover:border-emerald-300">
                                    <span class="font-semibold">{{ $ocasion }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Temporada --}}
                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Temporada
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach(['Primavera', 'Verano', 'Otoño', 'Invierno', 'Todo el año'] as $temporada)
                            <label class="relative">
                                <input type="radio" name="temporada" value="{{ $temporada }}" class="hidden peer" {{ $loop->first ? 'checked' : '' }}>
                                <div class="w-full p-4 text-center border-2 border-gray-200 rounded-xl cursor-pointer transition-all duration-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:text-emerald-700 hover:border-emerald-300">
                                    <span class="font-semibold">{{ $temporada }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Colores Preferidos --}}
                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>
                            Colores preferidos (opcional)
                        </label>
                        <input type="text" name="colores" placeholder="Ej: neutros, pasteles, colores vibrantes..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200">
                    </div>

                    {{-- Preferencias Adicionales --}}
                    <div class="mb-8">
                        <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Preferencias adicionales (opcional)
                        </label>
                        <textarea name="preferencias" rows="3" placeholder="Ej: Prefiero prendas holgadas, me gustan los accesorios..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-200 resize-none"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center">
                        <button type="submit" 
                                class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-4 px-12 rounded-2xl font-bold text-lg hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 shadow-lg hover:shadow-xl inline-flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            Generar Mis Outfits
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info Section --}}
            <div class="mt-8 text-center text-gray-600">
                <p class="flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Nuestra IA analizará todas las prendas disponibles para crear combinaciones únicas
                </p>
            </div>
        </div>
    </div>


    
    {{-- Footer --}}
    <x-footer />
    {{-- PANTALLA DE CARGA (CORREGIDA) --}}
    <div id="loading-overlay" class="fixed inset-0 bg-gray-900/80 z-[1000] hidden flex-col items-center justify-center backdrop-blur-sm">
        <div class="bg-white p-8 rounded-2xl shadow-2xl text-center max-w-sm mx-4 border border-emerald-100 transform scale-100 animate-pulse">
            {{-- Spinner --}}
            <div class="relative w-20 h-20 mx-auto mb-6">
                <div class="absolute inset-0 border-4 border-emerald-200 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-emerald-600 rounded-full border-t-transparent animate-spin"></div>
            </div>
            
            <h3 class="text-2xl font-bold text-gray-800 mb-2 font-serif">Diseñando tu Estilo...</h3>
            <p class="text-gray-600 text-base" id="loading-text">Analizando tus prendas.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('outfit-generator-form'); // Usamos el ID específico
            const overlay = document.getElementById('loading-overlay');
            const textElement = document.getElementById('loading-text');

            if (form && overlay) {
                form.addEventListener('submit', function(e) {
                    // No prevenimos el envío (e.preventDefault), dejamos que ocurra
                    
                    // 1. Mostrar overlay inmediatamente
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                    
                    // 2. Mensajes de espera
                    const messages = [
                        "🎨 Combinando colores...",
                        "👗 Revisando el clima...",
                        "👠 Buscando los zapatos ideales...",
                        "✨ ¡Dando los toques finales!"
                    ];
                    
                    let i = 0;
                    setInterval(() => {
                        if (i < messages.length) {
                            textElement.textContent = messages[i];
                            i++;
                        }
                    }, 2000);
                });
            } else {
                console.error("No se encontró el formulario #outfit-generator-form");
            }
        });
    </script>
</body>
</html>