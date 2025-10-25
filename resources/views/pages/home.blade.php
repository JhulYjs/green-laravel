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
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección Testimonios --}}
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
                    </div>
                </div>
            </div>
        </section>

    </main>
</x-app-layout>