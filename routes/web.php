<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController; // Controlador para productos
use App\Http\Controllers\CarritoController;  // Controlador para carrito
use App\Http\Controllers\ProfileController;  // Controlador para perfil (de Breeze)
use App\Http\Controllers\PedidoController;   // Controlador para pedidos
use App\Http\Controllers\FavoritoController; // Controlador para favoritos
use App\Http\Controllers\Admin\AdminDashboardController; // Controlador para admin dashboard
use App\Http\Controllers\Admin\AdminUserController; // Controlador para admin usuarios
use App\Http\Controllers\Admin\AdminProductoController; // Controlador para admin productos
use App\Http\Controllers\Admin\AdminPedidoController; // Controlador para admin pedidos
use App\Http\Controllers\SoporteController; // Controlador para soporte
use App\Http\Controllers\HomeController; // Controlador para páginas estáticas como "Sobre Nosotros"


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal (Index)
Route::get('/', [HomeController::class, 'showHome'])->name('home');

Route::get('/coleccion', [ProductoController::class, 'index'])->name('coleccion'); // Ruta para la colección de productos

// Ruta para detalles de un producto
Route::get('/producto/{producto}', [ProductoController::class, 'show'])->name('producto.show');

Route::get('/sobre-nosotros', [HomeController::class, 'sobreNosotros'])->name('sobre-nosotros');

Route::get('/ofertas', [ProductoController::class, 'ofertas'])->name('ofertas');

// --- AÑADE ESTAS RUTAS PARA SOPORTE ---
Route::get('/soporte', [SoporteController::class, 'index'])->name('soporte.index');
Route::post('/soporte', [SoporteController::class, 'procesar'])->name('soporte.procesar');
// ------------------------------------

// Rutas de Breeze para autenticación (login, register, etc.)
// Estas rutas están definidas en routes/auth.php
require __DIR__.'/auth.php';

// Rutas que requieren que el usuario esté autenticado
Route::middleware('auth')->group(function () {
    // Dashboard estándar de Breeze (redirige aquí después de login/register)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard'); // 'verified' es para verificación de email (opcional)

    // Rutas del Perfil (generadas por Breeze)
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

    // --- Gestión de Pedidos ---
    Route::get('/pedidos', [AdminPedidoController::class, 'index'])->name('pedidos.index'); 
    Route::get('/pedidos/{pedido}', [AdminPedidoController::class, 'show'])->name('pedidos.show'); 
    Route::put('/pedidos/{pedido}/estado', [AdminPedidoController::class, 'updateEstado'])->name('pedidos.updateEstado');

    Route::get('/soporte', [AdminDashboardController::class, 'verMensajesSoporte'])->name('soporte.index');
});
// ======================================================