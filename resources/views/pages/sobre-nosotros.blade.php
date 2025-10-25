<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                {{ __('Sobre Nosotros') }}
            </h2>
        </div>
    </x-slot>

    <main class="flex-grow">
        {{-- Sección Hero --}}
        <section class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 py-20 lg:py-28">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="inline-flex items-center space-x-2 bg-white px-6 py-3 rounded-full shadow-lg mb-8">
                    <span class="text-emerald-500">🌍</span>
                    <span class="text-sm font-bold text-emerald-700 uppercase tracking-wider">NUESTRA MISIÓN</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold font-serif bg-gradient-to-r from-gray-900 via-emerald-700 to-teal-600 bg-clip-text text-transparent">
                    Creemos en la moda circular
                </h1>
                <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Creamos una comunidad de confianza para comprar y vender prendas premium, extendiendo su ciclo de vida 
                    y reduciendo el impacto ambiental de la industria de la moda.
                </p>
                <div class="mt-10 flex justify-center space-x-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600">2022</div>
                        <div class="text-gray-600">Fundación</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-amber-600">500+</div>
                        <div class="text-gray-600">Prendas Rescatadas</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-teal-600">95%</div>
                        <div class="text-gray-600">Satisfacción</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Historia --}}
        <section class="py-20 lg:py-28 bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-3xl blur-lg opacity-20"></div>
                        <img src="https://placehold.co/600x700/4ade80/0f766e?text=GreenCloset+Historia" alt="Nuestra historia" class="relative rounded-2xl shadow-2xl w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="px-4">
                        <div class="inline-flex items-center space-x-2 bg-emerald-100 px-4 py-2 rounded-full mb-6">
                            <span class="text-emerald-600">📖</span>
                            <span class="text-sm font-bold text-emerald-700">NUESTRA HISTORIA</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-emerald-700 bg-clip-text text-transparent">
                            De una idea a una revolución sostenible
                        </h2>
                        <p class="mt-6 text-lg text-gray-700 leading-relaxed">
                            Lo que comenzó como un pequeño proyecto entre amigos apasionados por la moda vintage y la sostenibilidad, 
                            se ha convertido en una plataforma líder en moda circular.
                        </p>
                        <p class="mt-4 text-lg text-gray-700 leading-relaxed">
                            Cada prenda en nuestro catálogo ha sido inspeccionada, limpiada y preparada para que puedas disfrutarla 
                            con la misma emoción que su primer dueño. Nos enorgullece ofrecer calidad, transparencia y estilo consciente.
                        </p>
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="flex items-center space-x-4 p-4 bg-emerald-50 rounded-xl">
                                <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white text-xl">🔍</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Inspección Rigurosa</p>
                                    <p class="text-sm text-gray-600">Cada prenda verificada</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-amber-50 rounded-xl">
                                <div class="w-12 h-12 bg-amber-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white text-xl">✨</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Limpieza Profesional</p>
                                    <p class="text-sm text-gray-600">Lista para usar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Valores --}}
        <section class="py-20 lg:py-28 bg-gradient-to-br from-gray-50 to-emerald-50">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center space-x-2 bg-white px-6 py-3 rounded-full shadow-lg mb-8">
                        <span class="text-teal-500">💎</span>
                        <span class="text-sm font-bold text-teal-700 uppercase tracking-wider">NUESTROS VALORES</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold font-serif bg-gradient-to-r from-gray-800 to-teal-600 bg-clip-text text-transparent">
                        Lo que nos define
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-emerald-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-white text-2xl">♻️</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Sostenibilidad</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Reducimos el impacto ambiental extendiendo la vida útil de cada prenda y promoviendo 
                            prácticas de consumo responsable.
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-amber-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-white text-2xl">🤝</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Comunidad</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Construimos relaciones de confianza entre compradores y vendedores, creando una 
                            comunidad apasionada por la moda circular.
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-lg border border-teal-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="w-20 h-20 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-white text-2xl">⭐</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Calidad</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Garantizamos la autenticidad y el excelente estado de cada artículo a través de 
                            rigurosos procesos de verificación.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>