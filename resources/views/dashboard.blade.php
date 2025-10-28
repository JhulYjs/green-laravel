<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Bienvenida -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">
                    ¡Bienvenido de nuevo, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-xl text-gray-600">Gestiona tu tienda de forma eficiente</p>
            </div>

            <!-- Stats Grid - Datos REALES -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <!-- Mis Prendas - SOLO las del usuario -->
                <a href="{{ route('mis-prendas.index') }}" class="group">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500 transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">👕</span>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">
                                    @php
                                        $misProductos = \App\Models\Producto::where('usuario_id', auth()->id())->count();
                                        echo $misProductos;
                                    @endphp
                                </h3>
                                <p class="text-gray-600">Mis Prendas</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Total Pedidos - TODOS los pedidos -->
                <a href="{{ route('mis-pedidos.index') }}" class="group">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500 transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">📦</span>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">
                                    @php
                                        // TODOS los pedidos realizados
                                        $totalPedidos = \App\Models\Pedido::count();
                                        echo $totalPedidos;
                                    @endphp
                                </h3>
                                <p class="text-gray-600">Total Pedidos</p>
                                <p class="text-green-600 text-sm font-medium">
                                    @php
                                        $hoy = \Carbon\Carbon::today();
                                        $manana = \Carbon\Carbon::tomorrow();
                                        $pedidosHoy = \App\Models\Pedido::where('fecha_pedido', '>=', $hoy)
                                            ->where('fecha_pedido', '<', $manana)
                                            ->count();
                                        echo $pedidosHoy . ' hoy';
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Mis Favoritos -->
                <a href="{{ route('favoritos.index') }}" class="group">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500 transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-1">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg mr-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl">❤️</span>
                            </div>
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">
                                    {{ Auth::user()->favoritos->count() }}
                                </h3>
                                <p class="text-gray-600">Mis Favoritos</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="mb-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Acciones Rápidas</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Profile -->
                    <a href="{{ route('profile.edit') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl text-white">👤</span>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Mi Perfil</h4>
                            <p class="text-gray-600 text-sm">Editar información personal</p>
                        </div>
                    </a>

                    <!-- Colección -->
                    <a href="{{ route('coleccion') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-red-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl text-white">🛍️</span>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Ver Colección</h4>
                            <p class="text-gray-600 text-sm">Explorar productos</p>
                        </div>
                    </a>

                    <!-- Soporte -->
                    <a href="{{ route('soporte.index') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl text-white">💬</span>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Soporte</h4>
                            <p class="text-gray-600 text-sm">Ayuda y contacto</p>
                        </div>
                    </a>

                    <!-- Panel de Administrador - SOLO para admins -->
                    @if(Auth::user()->rol === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl text-white">⚙️</span>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Panel de Administrador</h4>
                            <p class="text-gray-600 text-sm">Gestión completa del sistema</p>
                        </div>
                    </a>
                    @else
                    <!-- Alternativa para usuarios normales -->
                    <a href="{{ route('carrito.get') }}" class="group">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center transition-all duration-300 hover:shadow-xl hover:transform hover:-translate-y-2">
                            <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                                <span class="text-2xl text-white">🛒</span>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Mi Carrito</h4>
                            <p class="text-gray-600 text-sm">Ver carrito de compras</p>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Historial de Pedidos - TODOS los pedidos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        Historial de Pedidos - {{ \Carbon\Carbon::now()->isoFormat('DD MMMM YYYY') }}
                    </h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('mis-pedidos.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">Ver todos</a>
                    </div>
                </div>
                
                <div class="space-y-4">
                    @php
                        // Obtener TODOS los pedidos recientes
                        $pedidosRecientes = \App\Models\Pedido::latest()
                            ->take(5)
                            ->get();
                    @endphp

                    <!-- Resumen -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-800 font-semibold">Resumen General</p>
                                <p class="text-blue-600 text-sm">
                                    {{ $pedidosRecientes->count() }} pedidos recientes
                                </p>
                            </div>
                            <div class="text-blue-800 font-bold">
                                Total: {{ \App\Models\Pedido::count() }} pedidos
                            </div>
                        </div>
                    </div>

                    @forelse($pedidosRecientes as $pedido)
                    <a href="{{ route('mis-pedidos.show', $pedido) }}" class="block hover:bg-gray-50 rounded-lg transition-colors border border-gray-200">
                        <div class="flex items-center p-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4
                                @if($pedido->estado == 'Entregado') bg-green-100 text-green-600
                                @elseif($pedido->estado == 'Procesando') bg-yellow-100 text-yellow-600
                                @elseif($pedido->estado == 'Enviado') bg-blue-100 text-blue-600
                                @else bg-gray-100 text-gray-600 @endif">
                                <span class="text-xl">
                                    @if($pedido->estado == 'Entregado') ✅
                                    @elseif($pedido->estado == 'Procesando') ⏳
                                    @elseif($pedido->estado == 'Enviado') 🚚
                                    @else 📦 @endif
                                </span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Pedido #{{ $pedido->id }}</p>
                                <p class="text-gray-600 text-sm">
                                    @if($pedido->fecha_pedido)
                                        {{ \Carbon\Carbon::parse($pedido->fecha_pedido)->format('H:i') }} • 
                                        €{{ number_format($pedido->total, 2) }}
                                    @else
                                        Reciente • €{{ number_format($pedido->total, 2) }}
                                    @endif
                                </p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($pedido->estado == 'Entregado') bg-green-100 text-green-800
                                @elseif($pedido->estado == 'Procesando') bg-yellow-100 text-yellow-800
                                @elseif($pedido->estado == 'Enviado') bg-blue-100 text-blue-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $pedido->estado ?? 'Pendiente' }}
                            </span>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">📦</span>
                        </div>
                        <p class="text-gray-500 mb-2">No hay pedidos</p>
                        <a href="{{ route('coleccion') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Realizar un pedido
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>