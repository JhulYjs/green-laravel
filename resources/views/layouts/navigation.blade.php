<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-md sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Logo Section --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center text-lg font-bold text-gray-900 tracking-wider">
                        {{-- Icono de Logo con colores de marca --}}
                        <x-application-logo class="block h-8 w-auto fill-current text-green-600 mr-2" />
                        <span class="hidden sm:inline text-green-600">Green</span><span class="text-gray-800">Closet</span>
                    </a>
                </div>

                {{-- Desktop Navigation Links --}}
                <div class="hidden space-x-6 sm:-my-px sm:ms-10 sm:flex items-center text-sm font-medium">
                    {{-- HOME (ADMIN ONLY) --}}
                    @if (Auth::check() && Auth::user()->rol === 'admin')
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endif
                    
                    {{-- Primary Links --}}
                    <x-nav-link :href="route('coleccion')" :active="request()->routeIs('coleccion')"> 
                        {{ __('Colección') }}
                    </x-nav-link>

                    <x-nav-link :href="route('ofertas')" :active="request()->routeIs('ofertas')" class="text-red-500 hover:text-red-700">
                        {{ __('Ofertas') }}
                    </x-nav-link>

                    @auth 
                    <x-nav-link :href="route('favoritos.index')" :active="request()->routeIs('favoritos.index')">
                        {{ __('Favoritos') }}
                    </x-nav-link>
                    @endauth

                    <x-nav-link :href="route('sobre-nosotros')" :active="request()->routeIs('sobre-nosotros')">
                        {{ __('Sobre Nosotros') }}
                    </x-nav-link>

                    <x-nav-link :href="route('soporte.index')" :active="request()->routeIs('soporte.index')">
                        {{ __('Soporte') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- Right Side: Auth, Cart, or Guest Links --}}
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- === BOTÓN CARRITO (Desktop) === --}}
                <button id="open-cart-button" class="p-2 rounded-full hover:bg-gray-100 relative mr-4 transition duration-150 group">
                    {{-- Icono mejorado con hover --}}
                    <svg class="h-6 w-6 text-gray-600 group-hover:text-green-700 transition" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    {{-- Indicador de conteo limpio --}}
                    <span id="cart-count-indicator" class="absolute top-0 right-0 block h-4 w-4 rounded-full bg-red-600 text-white text-xs text-center hidden font-bold leading-4 ring-1 ring-white transform translate-x-1 -translate-y-1">0</span>
                </button>
                {{-- === FIN BOTÓN CARRITO === --}}

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        {{-- Botón de usuario más sutil --}}
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->nombre_completo }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- ENLACE AL PANEL DE ADMIN (SOLO PARA ADMINS) --}}
                        @if (Auth::user()->rol === 'admin')
                            <x-dropdown-link :href="route('admin.dashboard')" class="font-bold text-green-600 hover:bg-green-50">
                                {{ __('Panel de Administración') }}
                            </x-dropdown-link>
                            <div class="border-t border-gray-100"></div>
                        @endif
                        {{-- FIN ENLACE ADMIN --}}

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Mi Perfil') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('mis-prendas.index')">
                            {{ __('Mis Prendas') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('mis-pedidos.index')">
                            {{ __('Mis Pedidos') }}
                        </x-dropdown-link>

                        <div class="border-t border-gray-100"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                             this.closest('form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth

            {{-- Guest Links (Desktop - Más profesional) --}}
            @guest
            <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                <a href="{{ route('login') }}" class="font-semibold text-gray-700 hover:text-green-600 transition">
                    {{ __('Iniciar Sesión') }}
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 border border-green-500 rounded-lg text-green-600 font-semibold hover:bg-green-50 transition ease-in-out duration-150">
                    {{ __('Registrarse') }}
                </a>
            </div>
            @endguest

            {{-- Mobile Button Toggles --}}
            <div class="-me-2 flex items-center sm:hidden">
                @auth
                    {{-- === BOTÓN CARRITO (Mobile) === --}}
                    <button id="open-cart-button" class="p-2 rounded-full hover:bg-gray-100 relative mr-1 transition duration-150">
                        <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.658-.463 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <span id="cart-count-indicator" class="absolute top-0 right-0 block h-4 w-4 rounded-full bg-red-600 text-white text-xs text-center hidden font-bold leading-4 ring-1 ring-white transform translate-x-1 -translate-y-1">0</span>
                    </button>
                    {{-- FIN BOTÓN CARRITO (Mobile) --}}
                @endauth
                
                {{-- Hamburger/Close Icon --}}
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Responsive Menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-50 border-t border-gray-100 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            {{-- ENLACES PRINCIPALES --}}
            
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('coleccion')" :active="request()->routeIs('coleccion')">
                {{ __('Colección') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('ofertas')" :active="request()->routeIs('ofertas')" class="!text-red-500">
                {{ __('Ofertas') }}
            </x-responsive-nav-link>
            
            @auth
             <x-responsive-nav-link :href="route('favoritos.index')" :active="request()->routeIs('favoritos.index')">
                 {{ __('Favoritos') }}
             </x-responsive-nav-link>
             @endauth
             
             <x-responsive-nav-link :href="route('sobre-nosotros')" :active="request()->routeIs('sobre-nosotros')">
                 {{ __('Sobre Nosotros') }}
             </x-responsive-nav-link>
             
             <x-responsive-nav-link :href="route('soporte.index')" :active="request()->routeIs('soporte.index')">
                 {{ __('Soporte') }}
             </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
            <div class="px-4">
                <div class="font-bold text-base text-gray-900">{{ Auth::user()->nombre_completo }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- PANEL DE ADMIN EN MÓVIL (SOLO PARA ADMINS) --}}
                @if (Auth::user()->rol === 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" class="font-bold text-green-600">
                    {{ __('Panel de Administración') }}
                </x-responsive-nav-link>
                @endif

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Mi Perfil') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('mis-prendas.index')">
                    {{ __('Mis Prendas') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('mis-pedidos.index')">
                    {{ __('Mis Pedidos') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                     this.closest('form').submit();" class="text-red-500 hover:bg-red-50">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
            @endauth
            
            @guest
            {{-- Guest Links (Mobile - Más profesional) --}}
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Iniciar Sesión') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="border border-green-500 text-green-600 hover:bg-green-50 rounded-md">
                    {{ __('Registrarse') }}
                </x-responsive-nav-link>
            </div>
            @endguest
        </div>
    </div>
</nav>