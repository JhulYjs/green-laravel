<<<<<<< HEAD
<footer class="bg-gradient-to-b from-gray-900 to-gray-800 mt-20 text-white">
=======
{{-- resources/views/components/footer.blade.php --}}
<footer class="bg-brand-100 mt-20">
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-8">
            {{-- Columna del Logo y Descripción --}}
            <div class="md:col-span-2">
<<<<<<< HEAD
                <div class="flex items-center space-x-3 mb-4">
                    <div class="p-3 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl shadow-lg">
                        <svg class="h-7 w-7 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.181-3.183m-4.991-2.691V5.25a3.75 3.75 0 013.75-3.75H18a3.75 3.75 0 013.75 3.75v.007M2.985 5.25h4.992" />
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-white font-serif bg-gradient-to-r from-emerald-400 to-teal-400 bg-clip-text text-transparent">GreenCloset</span>
                </div>
                <p class="text-gray-300 mb-6 max-w-sm leading-relaxed">Moda circular premium para una comunidad que valora la trazabilidad, la confianza y la sostenibilidad. Dale una segunda vida a tu estilo.</p>
                <div class="flex space-x-4">
                    <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center shadow-lg hover:shadow-emerald-500/25 transition-all duration-300">
                        <span class="text-white font-bold">♻️</span>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center shadow-lg hover:shadow-amber-500/25 transition-all duration-300">
                        <span class="text-white font-bold">🌱</span>
                    </div>
                </div>
            </div>
            {{-- Columna Comunidad --}}
            <div>
                <h4 class="font-bold text-emerald-400 mb-4 text-lg">COMUNIDAD</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-300 hover:text-emerald-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 group-hover:bg-emerald-300 transition-colors"></span>
                        Vender una prenda
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-emerald-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 group-hover:bg-emerald-300 transition-colors"></span>
                        Swap / Trueque
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-emerald-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2 group-hover:bg-emerald-300 transition-colors"></span>
                        Badges de confianza
                    </a></li>
=======
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
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                </ul>
            </div>
             {{-- Columna Empresa --}}
            <div>
<<<<<<< HEAD
                <h4 class="font-bold text-amber-400 mb-4 text-lg">EMPRESA</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('sobre-nosotros') }}" class="text-gray-300 hover:text-amber-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 group-hover:bg-amber-300 transition-colors"></span>
                        Sobre nosotros
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-amber-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 group-hover:bg-amber-300 transition-colors"></span>
                        Políticas
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-amber-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 group-hover:bg-amber-300 transition-colors"></span>
                        Sostenibilidad
                    </a></li>
=======
                <h4 class="font-bold text-brand-700 mb-4">EMPRESA</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('sobre-nosotros') }}" class="text-brand-600 hover:text-brand-900 transition-colors">Sobre nosotros</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Políticas</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Sostenibilidad</a></li>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                </ul>
            </div>
             {{-- Columna Soporte --}}
            <div>
<<<<<<< HEAD
                <h4 class="font-bold text-teal-400 mb-4 text-lg">SOPORTE</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('soporte.index') }}" class="text-gray-300 hover:text-teal-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-teal-500 rounded-full mr-2 group-hover:bg-teal-300 transition-colors"></span>
                        Ayuda
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-teal-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-teal-500 rounded-full mr-2 group-hover:bg-teal-300 transition-colors"></span>
                        Reportar artículo
                    </a></li>
                    <li><a href="#" class="text-gray-300 hover:text-teal-300 transition-all duration-300 hover:translate-x-1 flex items-center group">
                        <span class="w-2 h-2 bg-teal-500 rounded-full mr-2 group-hover:bg-teal-300 transition-colors"></span>
                        Contacto directo
                    </a></li>
=======
                <h4 class="font-bold text-brand-700 mb-4">SOPORTE</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('soporte.index') }}" class="text-brand-600 hover:text-brand-900 transition-colors">Ayuda</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Reportar artículo</a></li>
                    <li><a href="#" class="text-brand-600 hover:text-brand-900 transition-colors">Contacto directo</a></li>
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
                </ul>
            </div>
        </div>
    </div>
    {{-- Barra Inferior del Footer --}}
<<<<<<< HEAD
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 border-t border-gray-700">
         <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center text-sm">
             <p class="text-gray-400 mb-2 sm:mb-0 text-center sm:text-left">&copy; {{ date('Y') }} GreenCloset. Moda circular con impacto positivo. <span class="text-emerald-400">♻️</span></p>
             <div class="flex space-x-6 text-gray-400">
                 <a href="#" class="hover:text-emerald-400 transition-colors duration-300">Instagram</a>
                 <a href="#" class="hover:text-emerald-400 transition-colors duration-300">Facebook</a>
                 <a href="#" class="hover:text-emerald-400 transition-colors duration-300">TikTok</a>
=======
    <div class="bg-brand-100 border-t border-brand-200">
         <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row justify-between items-center text-sm">
             <p class="text-brand-500 mb-2 sm:mb-0">&copy; {{ date('Y') }} GreenCloset. Moda circular con impacto positivo.</p> {{-- Año dinámico --}}
             <div class="flex space-x-4 text-brand-500">
                 {{-- Aquí podrías añadir iconos de redes sociales si quisieras --}}
>>>>>>> e47cdeb84a46eff582ba89ac4e003f15711ff503
             </div>
         </div>
    </div>
</footer>