<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <div class="p-3 sm:p-4 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl sm:rounded-2xl shadow-lg relative overflow-hidden group">
                {{-- Imagen de fondo --}}
                <div class="absolute inset-0 bg-cover bg-center opacity-20 transition-transform duration-500 group-hover:scale-110" 
                     style="background-image: url('https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80')">
                </div>
                {{-- Overlay --}}
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 opacity-90 group-hover:opacity-80 transition-opacity duration-300"></div>
                {{-- Icono moderno --}}
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 5.5V7H9V5.5L3 7V9L5 9.5V19L3 20.5V22H5L7.5 21H16.5L19 22H21V20.5L19 19V9.5L21 9ZM7 19V9H17V19H7Z"/>
                </svg>
            </div>
            <h2 class="font-bold text-xl sm:text-2xl text-gray-800 leading-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                {{ __('Sobre Nosotros') }}
            </h2>
        </div>
    </x-slot>

    <main class="flex-grow">
        {{-- Sección Hero MEJORADA --}}
        <section class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-16 lg:py-28 relative overflow-hidden">
            {{-- Elementos decorativos de fondo --}}
            <div class="absolute top-10 left-10 w-20 h-20 bg-emerald-200 rounded-full blur-xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-32 h-32 bg-teal-200 rounded-full blur-xl opacity-30 animate-pulse delay-1000"></div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                {{-- Badge Misión con icono SVG --}}
                <div class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-4 py-2 sm:px-6 sm:py-3 rounded-full shadow-lg mb-6 sm:mb-8 border border-white/20">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                    </svg>
                    <span class="text-xs sm:text-sm font-bold text-emerald-700 uppercase tracking-wider">NUESTRA MISIÓN</span>
                </div>
                
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold font-serif bg-gradient-to-r from-gray-900 via-emerald-700 to-teal-600 bg-clip-text text-transparent leading-tight sm:leading-normal">
                    Creemos en la<br class="sm:hidden"> moda circular
                </h1>
                
                <p class="mt-4 sm:mt-6 text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed px-2">
                    Creamos una comunidad de confianza para comprar y vender prendas premium, extendiendo su ciclo de vida 
                    y reduciendo el impacto ambiental.
                </p>
                
                {{-- Estadísticas RESPONSIVE --}}
                <div class="mt-8 sm:mt-10 flex flex-wrap justify-center gap-4 sm:gap-6 md:gap-8">
                    <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20 min-w-[120px]">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-600">2022</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Fundación</div>
                    </div>
                    <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20 min-w-[120px]">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-amber-600">500+</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Prendas Rescatadas</div>
                    </div>
                    <div class="text-center bg-white/60 backdrop-blur-sm rounded-2xl p-4 sm:p-6 shadow-lg border border-white/20 min-w-[120px]">
                        <div class="text-2xl sm:text-3xl md:text-4xl font-bold text-teal-600">95%</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">Satisfacción</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Historia MEJORADA --}}
        <section class="py-16 lg:py-28 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                    {{-- Imagen --}}
                    <div class="relative order-2 lg:order-1">
                        <div class="absolute -inset-2 sm:-inset-4 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-2xl sm:rounded-3xl blur-lg opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Nuestra historia" 
                             class="relative rounded-xl sm:rounded-2xl shadow-2xl w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    {{-- Contenido --}}
                    <div class="px-2 sm:px-4 order-1 lg:order-2">
                        {{-- Badge Historia con icono SVG --}}
                        <div class="inline-flex items-center space-x-2 bg-emerald-100 px-3 py-1 sm:px-4 sm:py-2 rounded-full mb-4 sm:mb-6">
                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                            </svg>
                            <span class="text-xs sm:text-sm font-bold text-emerald-700">NUESTRA HISTORIA</span>
                        </div>
                        
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent leading-tight">
                            De una idea a una<br class="hidden sm:block"> revolución sostenible
                        </h2>
                        
                        <div class="mt-4 sm:mt-6 space-y-3 sm:space-y-4">
                            <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                                Lo que comenzó como un pequeño proyecto entre amigos apasionados por la moda vintage y la sostenibilidad, 
                                se ha convertido en una plataforma líder en moda circular.
                            </p>
                            <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                                Cada prenda en nuestro catálogo ha sido inspeccionada, limpiada y preparada para que puedas disfrutarla 
                                con la misma emoción que su primer dueño.
                            </p>
                        </div>
                        
                        {{-- Características con iconos SVG --}}
                        <div class="mt-6 sm:mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                            {{-- Inspección --}}
                            <div class="flex items-center space-x-3 p-3 sm:p-4 bg-emerald-50 rounded-xl sm:rounded-2xl hover:shadow-md transition-all duration-300">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm sm:text-base">Inspección Rigurosa</p>
                                    <p class="text-xs sm:text-sm text-gray-600">Cada prenda verificada</p>
                                </div>
                            </div>
                            
                            {{-- Limpieza --}}
                            <div class="flex items-center space-x-3 p-3 sm:p-4 bg-amber-50 rounded-xl sm:rounded-2xl hover:shadow-md transition-all duration-300">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-amber-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 2.01L6 2c-1.1 0-2 .89-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.11-.9-1.99-2-1.99zM18 20H6v-9h12v9zm0-11H6V4h12v5zm-4 6h-4v-2h4v2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm sm:text-base">Limpieza Profesional</p>
                                    <p class="text-xs sm:text-sm text-gray-600">Lista para usar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Valores MEJORADA --}}
        <section class="py-16 lg:py-28 bg-gradient-to-br from-gray-50 to-emerald-50 relative overflow-hidden">
            {{-- Elementos decorativos --}}
            <div class="absolute top-0 right-0 w-40 h-40 bg-teal-100 rounded-full blur-3xl opacity-30"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 bg-emerald-100 rounded-full blur-3xl opacity-20"></div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12 sm:mb-16">
                    {{-- Badge Valores con icono SVG --}}
                    <div class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-4 py-2 sm:px-6 sm:py-3 rounded-full shadow-lg mb-6 sm:mb-8 border border-white/20">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-teal-500" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                        </svg>
                        <span class="text-xs sm:text-sm font-bold text-teal-700 uppercase tracking-wider">NUESTROS VALORES</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-teal-600 bg-clip-text text-transparent leading-tight">
                        Lo que nos define
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    {{-- Sostenibilidad --}}
                    <div class="bg-white/80 backdrop-blur-sm p-6 sm:p-8 rounded-2xl shadow-lg border border-emerald-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">Sostenibilidad</h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                            Reducimos el impacto ambiental extendiendo la vida útil de cada prenda y promoviendo 
                            prácticas de consumo responsable.
                        </p>
                    </div>
                    
                    {{-- Comunidad --}}
                    <div class="bg-white/80 backdrop-blur-sm p-6 sm:p-8 rounded-2xl shadow-lg border border-amber-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">Comunidad</h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                            Construimos relaciones de confianza entre compradores y vendedores, creando una 
                            comunidad apasionada por la moda circular.
                        </p>
                    </div>
                    
                    {{-- Calidad --}}
                    <div class="bg-white/80 backdrop-blur-sm p-6 sm:p-8 rounded-2xl shadow-lg border border-teal-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 md:col-span-2 lg:col-span-1">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-6 shadow-lg">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">Calidad</h3>
                        <p class="text-sm sm:text-base text-gray-600 leading-relaxed">
                            Garantizamos la autenticidad y el excelente estado de cada artículo a través de 
                            rigurosos procesos de verificación.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
<!-- Cambio de estilos por Joha -->
