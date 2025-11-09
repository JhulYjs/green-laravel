<x-app-layout>
    <main class="flex-grow">
        {{-- Sección Hero MEJORADA --}}
        <section class="text-center py-16 lg:py-28 px-4 bg-gradient-to-br from-white via-emerald-50 to-teal-50 relative overflow-hidden">
            {{-- Elementos decorativos de fondo --}}
            <div class="absolute top-10 left-10 w-20 h-20 bg-emerald-200 rounded-full blur-xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-10 right-10 w-32 h-32 bg-teal-200 rounded-full blur-xl opacity-30 animate-pulse delay-1000"></div>
            
            <div class="max-w-4xl mx-auto relative z-10">
                <div class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg mb-6 border border-white/20">
                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <span class="text-xs sm:text-sm font-bold text-emerald-700 uppercase tracking-wide">Moda Circular Premium</span>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold font-serif bg-gradient-to-r from-gray-900 via-emerald-700 to-teal-600 bg-clip-text text-transparent leading-tight">
                    Dale una segunda vida<br class="hidden sm:block"> a la moda
                </h1>
                <p class="mt-4 sm:mt-6 text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed px-2">
                    Descubre prendas únicas con historia. Compra y vende moda sostenible de forma segura y consciente.
                </p>
                <div class="mt-8 sm:mt-10 flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <a href="{{ route('coleccion') }}" 
                       class="inline-flex items-center justify-center px-6 sm:px-8 lg:px-10 py-3 sm:py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold text-base sm:text-lg rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300 group">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                        Explora la Colección
                    </a>
                    <a href="{{ route('ofertas') }}" 
                       class="inline-flex items-center justify-center px-6 sm:px-8 lg:px-10 py-3 sm:py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-base sm:text-lg rounded-xl sm:rounded-2xl shadow-lg hover:shadow-xl hover:from-amber-600 hover:to-orange-600 transform hover:-translate-y-1 transition-all duration-300 group">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M11 8.75V3.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v3.75h1.75c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5H14v3.75c0 .83-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5V11.75H9.75c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5H11z"/>
                        </svg>
                        Ver Ofertas
                    </a>
                </div>
            </div>
        </section>

        {{-- Sección Estadísticas MEJORADA --}}
        <section class="py-12 sm:py-16 bg-white/80 backdrop-blur-sm">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 text-center">
                    <div class="bg-white/60 backdrop-blur-sm p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-emerald-600">500+</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2">Prendas Únicas</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-amber-600">1.2K+</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2">Clientes Felices</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-teal-600">95%</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2">Satisfacción</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm p-4 sm:p-6 rounded-xl sm:rounded-2xl shadow-lg border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="text-2xl sm:text-3xl lg:text-4xl font-bold text-orange-600">2.5T</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1 sm:mt-2">CO₂ Ahorrado</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Filosofía MEJORADA --}}
        <section class="bg-gradient-to-br from-gray-50 to-emerald-50 py-16 lg:py-24 relative overflow-hidden">
            {{-- Elementos decorativos --}}
            <div class="absolute top-0 right-0 w-40 h-40 bg-teal-100 rounded-full blur-3xl opacity-30"></div>
            <div class="absolute bottom-0 left-0 w-60 h-60 bg-emerald-100 rounded-full blur-3xl opacity-20"></div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                    <div class="relative order-2 lg:order-1">
                        <div class="absolute -inset-2 sm:-inset-4 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-2xl sm:rounded-3xl blur-lg opacity-20"></div>
                        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Prendas GreenCloset" 
                             class="relative rounded-xl sm:rounded-2xl shadow-2xl w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="px-2 sm:px-4 order-1 lg:order-2">
                        <div class="inline-flex items-center space-x-2 bg-white/80 backdrop-blur-sm px-3 py-1 sm:px-4 sm:py-2 rounded-full shadow-sm mb-4 sm:mb-6 border border-white/20">
                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <span class="text-xs sm:text-sm font-bold text-emerald-700">NUESTRA FILOSOFÍA</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent leading-tight">
                            Moda con<br class="hidden sm:block"> Propósito
                        </h2>
                        <div class="mt-4 sm:mt-6 space-y-3 sm:space-y-4">
                            <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                                En GreenCloset, creemos en la moda sostenible y en darle una segunda vida a prendas con historia. 
                                Seleccionamos cuidadosamente cada artículo para garantizar calidad y autenticidad.
                            </p>
                            <p class="text-base sm:text-lg text-gray-700 leading-relaxed">
                                Cada prenda ha sido inspeccionada, limpiada y preparada para que puedas disfrutarla con la misma 
                                emoción que su primer dueño.
                            </p>
                        </div>
                        <div class="mt-6 sm:mt-8 flex items-center space-x-3 sm:space-x-4 p-4 sm:p-6 bg-white/60 backdrop-blur-sm rounded-xl sm:rounded-2xl shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center shadow-lg flex-shrink-0">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800 text-sm sm:text-base">Moda Circular Certificada</p>
                                <p class="text-xs sm:text-sm text-gray-600">Cada compra reduce tu huella de carbono</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Testimonios MEJORADA --}}
        <section class="py-16 lg:py-24 bg-white/80 backdrop-blur-sm relative overflow-hidden">
            {{-- Elementos decorativos --}}
            <div class="absolute top-10 left-10 w-20 h-20 bg-amber-200 rounded-full blur-xl opacity-30"></div>
            <div class="absolute bottom-10 right-10 w-32 h-32 bg-orange-200 rounded-full blur-xl opacity-30"></div>
            
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center mb-12 sm:mb-16">
                    <div class="inline-flex items-center space-x-2 bg-amber-100/80 backdrop-blur-sm px-4 py-2 rounded-full shadow-sm mb-4 sm:mb-6 border border-amber-200/20">
                        <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <span class="text-xs sm:text-sm font-bold text-amber-700">TESTIMONIOS</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-amber-600 bg-clip-text text-transparent leading-tight">
                        Lo Que Dicen<br class="sm:hidden"> Nuestros Clientes
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
                    {{-- Testimonio 1 --}}
                    <div class="bg-white/80 backdrop-blur-sm p-6 sm:p-8 rounded-xl sm:rounded-2xl border border-emerald-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-amber-400 text-xl sm:text-2xl mb-3 sm:mb-4">★★★★★</div>
                        <p class="text-gray-700 italic text-sm sm:text-base leading-relaxed">"Encontré un vestido de los 70s en perfecto estado. ¡El servicio fue excelente y la calidad superó mis expectativas!"</p>
                        <div class="mt-4 sm:mt-6 flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base mr-3 sm:mr-4 shadow-lg">
                                AG
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm sm:text-base">Ana García</p>
                                <p class="text-xs sm:text-sm text-emerald-600">Cliente desde 2023</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Testimonio 2 --}}
                    <div class="bg-white/80 backdrop-blur-sm p-6 sm:p-8 rounded-xl sm:rounded-2xl border border-amber-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-amber-400 text-xl sm:text-2xl mb-3 sm:mb-4">★★★★★</div>
                        <p class="text-gray-700 italic text-sm sm:text-base leading-relaxed">"La chaqueta de cuero que compré parece nueva. No puedo creer que sea de segunda mano. Volveré por más sin duda."</p>
                        <div class="mt-4 sm:mt-6 flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base mr-3 sm:mr-4 shadow-lg">
                                CM
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm sm:text-base">Carlos Mendoza</p>
                                <p class="text-xs sm:text-sm text-amber-600">Cliente frecuente</p>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Testimonio 3 --}}
                    <div class="bg-white/80 backdrop-blur-sm p-6 sm:p-8 rounded-xl sm:rounded-2xl border border-teal-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-amber-400 text-xl sm:text-2xl mb-3 sm:mb-4">★★★★★</div>
                        <p class="text-gray-700 italic text-sm sm:text-base leading-relaxed">"Me encanta la filosofía de la tienda. Cada prenda tiene una historia y la calidad es impecable. 100% recomendado."</p>
                        <div class="mt-4 sm:mt-6 flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base mr-3 sm:mr-4 shadow-lg">
                                SL
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm sm:text-base">Sofía López</p>
                                <p class="text-xs sm:text-sm text-teal-600">Amante de la moda vintage</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
<!-- Cambio de estilos por Joha -->
