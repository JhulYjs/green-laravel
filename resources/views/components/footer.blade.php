{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-brand-100 mt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-8">
            {{-- Columna del Logo y Descripción --}}
            <div class="md:col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    {{-- Logo SVG (puedes usar x-application-logo o tu propio SVG/img) --}}
                    <div class="p-2 bg-brand-200 rounded-full">
                        <svg class="h-6 w-6 text-brand-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.181-3.183m-4.991-2.691V5.25a3.75 3.75 0 013.75-3.75H18a3.75 3.75 0 013.75 3.75v.007M2.985 5.25h4.992" /></svg>
                    </div>
                    <span class="text-xl font-bold text-brand-700 font-serif">GreenCloset</span>
                </div>
                <p class="text-brand-600 mb-6 max-w-sm">Moda circular premium para una comunidad que valora la trazabilidad, la confianza y la sostenibilidad.</p>
            </div>
            {{-- Columna Comunidad --}}
            <div>
                <h4 class="font-bold text-brand-700 mb-4">COMUNIDAD</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Vender una prenda</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Swap / Trueque</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Badges de confianza</a></li>
                </ul>
            </div>
             {{-- Columna Empresa --}}
            <div>
                <h4 class="font-bold text-brand-700 mb-4">EMPRESA</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('sobre-nosotros') }}" class="text-brand-600 hover:text-brand-900 transition-colors">Sobre nosotros</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Políticas</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Sostenibilidad</a></li>
                </ul>
            </div>
             {{-- Columna Soporte --}}
            <div>
                <h4 class="font-bold text-brand-700 mb-4">SOPORTE</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('soporte.index') }}" class="text-brand-600 hover:text-brand-900 transition-colors">Ayuda</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Reportar artículo</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Contacto directo</a></li>
                </ul>
            </div>
        </div>
    </div>
    {{-- Barra Inferior del Footer --}}
    <div class="bg-brand-100 border-t border-brand-200">
         <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center text-sm">
             <p class="text-brand-500 mb-2 sm:mb-0">&copy; {{ date('Y') }} GreenCloset. Moda circular con impacto positivo.</p> {{-- Año dinámico --}}
             <div class="flex space-x-4 text-brand-500">
                 {{-- Aquí podrías añadir iconos de redes sociales si quisieras --}}
             </div>
         </div>
    </div>
</footer>