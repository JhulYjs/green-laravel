<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // agregada para evitar 'Undefined type Log'
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductoController;
use App\Http\Controllers\Admin\AdminPedidoController;
use App\Http\Controllers\SoporteController;
use App\Http\Controllers\HomeController;

// ========== RUTAS PÚBLICAS ==========
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/', [HomeController::class, 'showHome'])->name('home.main');    
Route::get('/coleccion', [ProductoController::class, 'index'])->name('coleccion');
Route::get('/producto/{producto}', [ProductoController::class, 'show'])->name('producto.show');
Route::get('/sobre-nosotros', [HomeController::class, 'sobreNosotros'])->name('sobre-nosotros');
Route::get('/ofertas', [ProductoController::class, 'ofertas'])->name('ofertas');
Route::get('/soporte', [SoporteController::class, 'index'])->name('soporte.index');
Route::post('/soporte', [SoporteController::class, 'procesar'])->name('soporte.procesar');

require __DIR__.'/auth.php';

// ========== RUTAS AUTENTICADAS ==========
Route::middleware('auth')->group(function () {
    // DASHBOARD - DIFERENTE PARA CADA TIPO DE USUARIO
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
    Log::info("Acceso a /dashboard - Usuario: {$user->email}, Rol: {$user->rol}");
        
        // ADMIN ve dashboard con estadísticas
        if ($user->rol === 'admin') {
            return view('dashboard'); // ← dashboard.blade.php con panel admin
        }
        
        // USUARIO NORMAL ve dashboard simple
        return view('home-user'); // ← home-user.blade.php simple
    })->name('dashboard');

    // Ruta HOME (redirige al dashboard)
    Route::get('/home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas del Carrito
    Route::post('/carrito/add/{producto}', [CarritoController::class, 'add'])->name('carrito.add');
    Route::get('/carrito', [CarritoController::class, 'get'])->name('carrito.get');
    Route::delete('/carrito/remove/{producto}', [CarritoController::class, 'remove'])->name('carrito.remove');

    // Rutas de Pedidos
    Route::post('/pedido', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/pedido/exito/{pedido}', [PedidoController::class, 'exito'])->name('pedido.exito');

    // Rutas de Favoritos
    Route::get('/favoritos', [FavoritoController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos/toggle/{producto}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    Route::get('/favoritos/ids', [FavoritoController::class, 'getIds'])->name('favoritos.getIds');

    // Rutas de "Mis Prendas"
    Route::prefix('mis-prendas')->name('mis-prendas.')->group(function () {
        Route::get('/', [ProductoController::class, 'misPrendas'])->name('index');
        Route::get('/{producto}/editar', [ProductoController::class, 'edit'])->name('edit');
        Route::put('/{producto}', [ProductoController::class, 'update'])->name('update');
        Route::delete('/{producto}', [ProductoController::class, 'destroy'])->name('destroy');

        Route::get('/subir-prenda', [ProductoController::class, 'create'])->name('subir-prenda');
        Route::post('/subir-prenda', [ProductoController::class, 'store'])->name('subir-prenda.store');
    });

    // Rutas de "Mis Pedidos"
    Route::prefix('mis-pedidos')->name('mis-pedidos.')->group(function () {
        Route::get('/', [PedidoController::class, 'index'])->name('index');
        Route::get('/{pedido}', [PedidoController::class, 'show'])->name('show');
    });

    
});

// ========== RUTAS DEL PANEL DE ADMINISTRACIÓN ==========
Route::middleware(['auth', \App\Http\Middleware\CheckAdminRole::class]) 
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // --- Gestión de Usuarios ---
    Route::get('/usuarios', [AdminUserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{usuario}/editar', [AdminUserController::class, 'edit'])->name('usuarios.edit'); 
    Route::put('/usuarios/{usuario}', [AdminUserController::class, 'update'])->name('usuarios.update'); 
    Route::delete('/usuarios/{usuario}', [AdminUserController::class, 'destroy'])->name('usuarios.destroy'); 

    // --- Gestión de Productos ---
    Route::get('/productos/crear', [AdminProductoController::class, 'create'])->name('productos.create'); 
    Route::post('/productos', [AdminProductoController::class, 'store'])->name('productos.store');  
    Route::get('/productos', [AdminProductoController::class, 'index'])->name('productos.index'); 
    Route::get('/productos/{producto}/editar', [AdminProductoController::class, 'edit'])->name('productos.edit'); 
    Route::put('/productos/{producto}', [AdminProductoController::class, 'update'])->name('productos.update'); 
    Route::delete('/productos/{producto}', [AdminProductoController::class, 'destroy'])->name('productos.destroy');

    Route::get('/productos/pendientes', [AdminProductoController::class, 'pendientes'])->name('productos.pendientes');
    Route::patch('/productos/{producto}/aprobar', [AdminProductoController::class, 'aprobar'])->name('productos.aprobar');
    Route::get('/productos/{producto}/rechazar', [AdminProductoController::class, 'mostrarFormRechazar'])->name('productos.mostrar-rechazar');
    Route::patch('/productos/{producto}/rechazar', [AdminProductoController::class, 'rechazar'])->name('productos.rechazar');

    // --- Gestión de Pedidos ---
    Route::get('/pedidos', [AdminPedidoController::class, 'index'])->name('pedidos.index'); 
    Route::get('/pedidos/{pedido}', [AdminPedidoController::class, 'show'])->name('pedidos.show'); 
    Route::put('/pedidos/{pedido}/estado', [AdminPedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');

    Route::get('/soporte', [AdminDashboardController::class, 'verMensajesSoporte'])->name('soporte.index');
});


// ========== RUTAS PARA GENERADOR DE OUTFITS ==========
require __DIR__.'/outfits.php';