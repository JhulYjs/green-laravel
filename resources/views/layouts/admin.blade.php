<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Token CSRF --}}

    {{-- Usamos ?? para un título por defecto --}}
    <title>@yield('title', 'Admin Panel') - GreenCloset</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- Incluimos tus fuentes originales --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Incluimos tu configuración de Tailwind directamente aquí para las clases 'brand' --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 
                        'sans': ['Figtree', 'Inter', 'sans-serif'], // Combina Figtree (de Breeze) con Inter
                        'serif': ['Playfair Display', 'serif'] 
                    },
                    colors: { 
                        'brand': { 
                            '50': '#f4f6f3', '100': '#e5e9e2', '200': '#cbd3c7', '300': '#94a68e',
                            '400': '#7c9176', '500': '#5c7356', '600': '#455a41', '700': '#374834',
                            '800': '#2d3a2b', '900': '#253024', '950': '#141a14' 
                        } 
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-brand-50">
    <div class="flex h-screen bg-brand-50">
        {{-- Barra Lateral (Sidebar) - Adaptada de tu header.php --}}
        <div class="w-64 bg-brand-800 text-brand-100 flex flex-col shadow-lg">
            <div class="p-6 text-center border-b border-brand-700">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-serif font-bold text-white">Admin</a>
                <p class="text-xs text-brand-300">GreenCloset</p>
            </div>
            <nav class="flex-grow p-4 space-y-2">
                {{-- Enlace Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-2 rounded-lg font-semibold transition-colors duration-200 
                          {{ request()->routeIs('admin.dashboard') ? 'bg-brand-900 text-white' : 'text-brand-200 hover:bg-brand-700 hover:text-white' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                {{-- Enlace Usuarios --}}
                <a href="{{ route('admin.usuarios.index') }}" 
                   class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.usuarios.*') ? 'bg-brand-900 text-white font-semibold' : 'text-brand-200 hover:bg-brand-700 hover:text-white' }}"> {{-- <-- CORREGIDO --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Usuarios
                </a>
                {{-- Enlace Productos --}}
                <a href="{{ route('admin.productos.index') }}"
                   class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.productos.*') ? 'bg-brand-900 text-white font-semibold' : 'text-brand-200 hover:bg-brand-700 hover:text-white' }}"> {{-- <-- CORREGIDO --}}
                   <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Productos
                </a>
                {{-- Enlace Pedidos --}}
                 <a href="{{ route('admin.pedidos.index') }}"
                    class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200 
                           {{ request()->routeIs('admin.pedidos.*') ? 'bg-brand-900 text-white font-semibold' : 'text-brand-200 hover:bg-brand-700 hover:text-white' }}"> {{-- <-- CORREGIDO --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                     Pedidos
                 </a>
                {{-- Enlace Soporte --}}
                 <a href="{{ route('admin.soporte.index') }}"
                   class="flex items-center px-4 py-2 rounded-lg transition-colors duration-200
                          {{ request()->routeIs('admin.soporte.*') ? 'bg-brand-900 text-white font-semibold' : 'text-brand-200 hover:bg-brand-700 hover:text-white' }}">
                    {{-- Icono Opcional (ejemplo: un sobre) --}}
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Mensajes Soporte
                </a>
            </nav>
            {{-- Botón Logout --}}
            <div class="p-4 border-t border-brand-700 space-y-2"> {{-- Añadido space-y-2 --}}
                {{-- === AÑADE ENLACE VER TIENDA === --}}
                <a href="{{ route('home') }}" {{-- Apunta a la ruta de inicio pública --}}
                target="_blank" {{-- Abre en una nueva pestaña (opcional) --}}
                class="flex items-center w-full px-4 py-2 rounded-lg text-brand-200 hover:bg-brand-700 hover:text-white transition-colors duration-200">
                {{-- Icono Opcional (ejemplo: un ojo o una tienda) --}}
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Ver Tienda
                </a>
                {{-- ============================== --}}

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 rounded-lg text-brand-200 hover:bg-red-800 hover:text-white transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        {{-- Área Principal de Contenido --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Cabecera Superior --}}
            <header class="bg-white border-b border-brand-200 shadow-sm">
                <div class="px-6 py-4 flex justify-between items-center">
                    {{-- Usamos $header si se define en la vista hija, o el título --}}
                    <h1 class="text-xl font-semibold text-brand-800">{{ $header ?? $title ?? 'Admin Panel' }}</h1>
                    <span class="text-sm text-brand-600">Hola, {{ Auth::user()->nombre_completo ?? 'Admin' }}</span>
                </div>
            </header>
            {{-- Contenido Principal (inyectado desde la vista hija) --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-brand-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>