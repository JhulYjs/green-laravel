<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sobre Nosotros') }}
        </h2>
    </x-slot>

    <main class="flex-grow">
        {{-- Adaptación del contenido de sobre-nosotros.php --}}
        <section class="bg-brand-100/70">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-24 text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-brand-500">NUESTRA MISIÓN</p>
                <h1 class="text-4xl md:text-5xl font-bold text-brand-800 font-serif mt-2">Creemos en la moda circular.</h1>
                <p class="mt-4 max-w-3xl mx-auto text-brand-600 text-lg">Creamos una comunidad de confianza para comprar y vender prendas premium, extendiendo su ciclo de vida y reduciendo el impacto ambiental de la industria.</p>
            </div>
        </section>

        <section class="py-20 lg:py-24">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="px-8">
                        {{-- Placeholder o imagen real --}}
                        <img src="https://placehold.co/600x700/e5e9e2/2d3a2b?text=GreenCloset+Historia" alt="Nuestra historia" class="rounded-2xl shadow-xl w-full h-auto object-cover">
                    </div>
                    <div>
                        <h2 class="text-3xl md:text-4xl font-bold text-brand-800 font-serif">Nuestra Historia</h2>
                        <p class="mt-4 text-brand-600">Lo que comenzó como un pequeño proyecto entre amigos apasionados por la moda vintage y la sostenibilidad, se ha convertido en una plataforma líder en moda circular. Cada prenda en nuestro catálogo ha sido inspeccionada, limpiada y preparada para que puedas disfrutarla con la misma emoción que su primer dueño.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>