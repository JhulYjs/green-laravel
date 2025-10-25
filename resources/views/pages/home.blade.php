<<<<<<< HEAD
<x-app-layout>
    <main class="flex-grow">
        {{-- Sección Hero --}}
        <section class="text-center py-20 lg:py-32 px-4 bg-gradient-to-br from-white via-emerald-50 to-teal-50">
            <div class="max-w-4xl mx-auto">
                <div class="inline-flex items-center space-x-2 bg-emerald-100 px-4 py-2 rounded-full mb-6">
                    <span class="text-emerald-600">♻️</span>
                    <span class="text-sm font-bold text-emerald-700 uppercase tracking-wide">Moda Circular Premium</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-bold font-serif bg-gradient-to-r from-gray-900 via-emerald-700 to-teal-600 bg-clip-text text-transparent">
                    Dale una segunda vida a la moda
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Descubre prendas únicas con historia. Compra y vende moda sostenible de forma segura y consciente.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('coleccion') }}" 
                       class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-bold text-lg rounded-2xl shadow-xl hover:from-emerald-600 hover:to-teal-600 transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Explora la Colección
                    </a>
                    <a href="{{ route('ofertas') }}" 
                       class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold text-lg rounded-2xl shadow-xl hover:from-amber-600 hover:to-orange-600 transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                        Ver Ofertas
                    </a>
                </div>
            </div>
        </section>

        {{-- Sección Estadísticas --}}
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div class="p-6">
                        <div class="text-3xl font-bold text-emerald-600">500+</div>
                        <div class="text-gray-600 mt-2">Prendas Únicas</div>
                    </div>
                    <div class="p-6">
                        <div class="text-3xl font-bold text-amber-600">1.2K+</div>
                        <div class="text-gray-600 mt-2">Clientes Felices</div>
                    </div>
                    <div class="p-6">
                        <div class="text-3xl font-bold text-teal-600">95%</div>
                        <div class="text-gray-600 mt-2">Satisfacción</div>
                    </div>
                    <div class="p-6">
                        <div class="text-3xl font-bold text-orange-600">2.5T</div>
                        <div class="text-gray-600 mt-2">CO₂ Ahorrado</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Filosofía --}}
        <section class="bg-gradient-to-br from-gray-50 to-emerald-50 py-20 lg:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-3xl blur-lg opacity-20"></div>
                        <img src="https://placehold.co/600x700/4ade80/0f766e?text=GreenCloset+Moda" alt="Prendas GreenCloset" class="relative rounded-2xl shadow-2xl w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="px-4">
                        <div class="inline-flex items-center space-x-2 bg-white px-4 py-2 rounded-full shadow-sm mb-6">
                            <span class="text-emerald-500">🌱</span>
                            <span class="text-sm font-bold text-emerald-700">NUESTRA FILOSOFÍA</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent">
                            Moda con Propósito
                        </h2>
                        <p class="mt-6 text-lg text-gray-700 leading-relaxed">
                            En GreenCloset, creemos en la moda sostenible y en darle una segunda vida a prendas con historia. 
                            Seleccionamos cuidadosamente cada artículo para garantizar calidad y autenticidad.
                        </p>
                        <p class="mt-4 text-lg text-gray-700 leading-relaxed">
                            Cada prenda ha sido inspeccionada, limpiada y preparada para que puedas disfrutarla con la misma 
                            emoción que su primer dueño.
                        </p>
                        <div class="mt-8 flex items-center space-x-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-lg">♻️</span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Moda Circular Certificada</p>
                                <p class="text-sm text-gray-600">Cada compra reduce tu huella de carbono</p>
                            </div>
                        </div>
=======
{{-- Usa el layout principal --}}
<x-app-layout>
    {{-- No necesitamos un header específico aquí --}}
    
    <main class="flex-grow">
        {{-- Sección Hero --}}
        <section class="text-center py-20 lg:py-32 px-4 bg-gradient-to-b from-white to-brand-50">
            <h1 class="text-4xl md:text-6xl font-bold text-brand-800 font-serif">Dale una segunda vida a la moda.</h1>
            <p class="mt-4 max-w-2xl mx-auto text-brand-600">Descubre prendas únicas con historia. Compra y vende moda sostenible de una forma segura y consciente.</p>
            {{-- Enlace a la nueva ruta de colección --}}
            <a href="{{ route('coleccion') }}" 
               class="inline-block mt-8 bg-brand-500 text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-600 transition-transform hover:scale-105 duration-300 shadow-lg">
                Explora la colección
            </a>
        </section>

        {{-- Sección Historia (similar a sobre-nosotros) --}}
        <section class="bg-brand-100/70 py-20 lg:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="px-8">
                         {{-- Placeholder o imagen real --}}
                        <img src="https://placehold.co/600x700/e5e9e2/2d3a2b?text=GreenCloset+Moda" alt="Prendas GreenCloset" class="rounded-2xl shadow-xl w-full h-auto object-cover">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif">Nuestra Filosofía</h2>
                        <p class="mt-4 text-brand-600">En GreenCloset, creemos en la moda sostenible y en darle una segunda vida a prendas con historia. Seleccionamos cuidadosamente cada artículo.</p>
                        <p class="mt-4 text-brand-600">Cada prenda ha sido inspeccionada, limpiada y preparada para que puedas disfrutarla con la misma emoción que su primer dueño.</p>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Testimonios --}}
<<<<<<< HEAD
        <section class="py-20 lg:py-24 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center space-x-2 bg-amber-100 px-4 py-2 rounded-full mb-4">
                        <span class="text-amber-600">⭐</span>
                        <span class="text-sm font-bold text-amber-700">TESTIMONIOS</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-amber-600 bg-clip-text text-transparent">
                        Lo Que Dicen Nuestros Clientes
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-gradient-to-br from-white to-emerald-50 p-8 rounded-2xl border border-emerald-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-amber-400 text-2xl mb-4">★★★★★</div>
                        <p class="text-gray-700 italic text-lg leading-relaxed">"Encontré un vestido de los 70s en perfecto estado. ¡El servicio fue excelente y la calidad superó mis expectativas!"</p>
                        <div class="mt-6 flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                AG
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Ana García</p>
                                <p class="text-sm text-emerald-600">Cliente desde 2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-white to-amber-50 p-8 rounded-2xl border border-amber-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-amber-400 text-2xl mb-4">★★★★★</div>
                        <p class="text-gray-700 italic text-lg leading-relaxed">"La chaqueta de cuero que compré parece nueva. No puedo creer que sea de segunda mano. Volveré por más sin duda."</p>
                        <div class="mt-6 flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                CM
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Carlos Mendoza</p>
                                <p class="text-sm text-amber-600">Cliente frecuente</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-br from-white to-teal-50 p-8 rounded-2xl border border-teal-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="text-amber-400 text-2xl mb-4">★★★★★</div>
                        <p class="text-gray-700 italic text-lg leading-relaxed">"Me encanta la filosofía de la tienda. Cada prenda tiene una historia y la calidad es impecable. 100% recomendado."</p>
                        <div class="mt-6 flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                SL
                            </div>
                            <div>
                                <p class="font-bold text-gray-800">Sofía López</p>
                                <p class="text-sm text-teal-600">Amante de la moda vintage</p>
                            </div>
                        </div>
=======
        <section class="py-20 lg:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl md:text-4xl font-bold text-center text-brand-800 font-serif">Lo Que Dicen Nuestros Clientes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                    <div class="bg-brand-50 p-8 rounded-lg border border-brand-100 shadow-sm">
                        <p class="text-brand-600 italic">"Encontré un vestido de los 70s en perfecto estado. ¡El servicio fue excelente!"</p>
                        <p class="mt-2 text-sm font-semibold text-brand-700">- Ana G.</p>
                    </div>
                    <div class="bg-brand-50 p-8 rounded-lg border border-brand-100 shadow-sm">
                       <p class="text-brand-600 italic">"La chaqueta de cuero que compré parece nueva. No puedo creer que sea de segunda mano. Volveré por más."</p>
                       <p class="mt-2 text-sm font-semibold text-brand-700">- Carlos M.</p>
                    </div>
                    <div class="bg-brand-50 p-8 rounded-lg border border-brand-100 shadow-sm">
                        <p class="text-brand-600 italic">"Me encanta la filosofía de la tienda. Cada prenda tiene una historia y la calidad es impecable."</p>
                         <p class="mt-2 text-sm font-semibold text-brand-700">- Sofía L.</p>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                    </div>
                </div>
            </div>
        </section>
<<<<<<< HEAD
=======

>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    </main>
</x-app-layout>