<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimientoStockController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->middleware('permission:usuarios.ver')->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->middleware('permission:usuarios.crear')->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->middleware('permission:usuarios.crear')->name('usuarios.store');
    Route::get('/usuarios/{user}', [UsuarioController::class, 'show'])->middleware('permission:usuarios.ver')->name('usuarios.show');
    Route::get('/usuarios/{user}/edit', [UsuarioController::class, 'edit'])->middleware('permission:usuarios.editar')->name('usuarios.edit');
    Route::put('/usuarios/{user}', [UsuarioController::class, 'update'])->middleware('permission:usuarios.editar')->name('usuarios.update');
    Route::delete('/usuarios/{user}', [UsuarioController::class, 'destroy'])->middleware('permission:usuarios.eliminar')->name('usuarios.destroy');

    Route::get('/roles', [RoleController::class, 'index'])->middleware('permission:roles.ver')->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->middleware('permission:roles.crear')->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->middleware('permission:roles.crear')->name('roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->middleware('permission:roles.ver')->name('roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->middleware('permission:roles.editar')->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->middleware('permission:roles.editar')->name('roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->middleware('permission:roles.eliminar')->name('roles.destroy');

    Route::get('/productos', [ProductoController::class, 'index'])->middleware('permission:productos.ver')->name('productos.index');
    Route::get('/productos/create', [ProductoController::class, 'create'])->middleware('permission:productos.crear')->name('productos.create');
    Route::post('/productos', [ProductoController::class, 'store'])->middleware('permission:productos.crear')->name('productos.store');
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->middleware('permission:productos.ver')->name('productos.show');
    Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->middleware('permission:productos.editar')->name('productos.edit');
    Route::put('/productos/{producto}', [ProductoController::class, 'update'])->middleware('permission:productos.editar')->name('productos.update');
    Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->middleware('permission:productos.eliminar')->name('productos.destroy');

    Route::get('/categorias', [CategoriaController::class, 'index'])->middleware('permission:categorias.ver')->name('categorias.index');
    Route::get('/categorias/create', [CategoriaController::class, 'create'])->middleware('permission:categorias.crear')->name('categorias.create');
    Route::post('/categorias', [CategoriaController::class, 'store'])->middleware('permission:categorias.crear')->name('categorias.store');
    Route::get('/categorias/{categoria}', [CategoriaController::class, 'show'])->middleware('permission:categorias.ver')->name('categorias.show');
    Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->middleware('permission:categorias.editar')->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriaController::class, 'update'])->middleware('permission:categorias.editar')->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriaController::class, 'destroy'])->middleware('permission:categorias.eliminar')->name('categorias.destroy');

    Route::get('/proveedores', [ProveedorController::class, 'index'])->middleware('permission:proveedores.ver')->name('proveedores.index');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->middleware('permission:proveedores.crear')->name('proveedores.create');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->middleware('permission:proveedores.crear')->name('proveedores.store');
    Route::get('/proveedores/{proveedor}', [ProveedorController::class, 'show'])->middleware('permission:proveedores.ver')->name('proveedores.show');
    Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->middleware('permission:proveedores.editar')->name('proveedores.edit');
    Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->middleware('permission:proveedores.editar')->name('proveedores.update');
    Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->middleware('permission:proveedores.eliminar')->name('proveedores.destroy');

    // Route::get('/cajas', [CajaController::class, 'index'])->middleware('permission:cajas.ver')->name('cajas.index');
    // Route::get('/cajas/create', [CajaController::class, 'create'])->middleware('permission:cajas.crear')->name('cajas.create');
    // Route::post('/cajas', [CajaController::class, 'store'])->middleware('permission:cajas.crear')->name('cajas.store');
    // Route::get('/cajas/{caja}', [CajaController::class, 'show'])->middleware('permission:cajas.ver')->name('cajas.show');
    // Route::get('/cajas/{caja}/edit', [CajaController::class, 'edit'])->middleware('permission:cajas.editar')->name('cajas.edit');
    // Route::put('/cajas/{caja}', [CajaController::class, 'update'])->middleware('permission:cajas.editar')->name('cajas.update');
    // Route::delete('/cajas/{caja}', [CajaController::class, 'destroy'])->middleware('permission:cajas.eliminar')->name('cajas.destroy');

    Route::get('/compras', [CompraController::class, 'index'])->middleware('permission:compras.ver')->name('compras.index');
    Route::get('/compras/create', [CompraController::class, 'create'])->middleware('permission:compras.crear')->name('compras.create');
    Route::post('/compras', [CompraController::class, 'store'])->middleware('permission:compras.crear')->name('compras.store');
    Route::get('/compras/{compra}', [CompraController::class, 'show'])->middleware('permission:compras.ver')->name('compras.show');
    Route::delete('/compras/{compra}', [CompraController::class, 'destroy'])->middleware('permission:compras.eliminar')->name('compras.destroy');

    Route::get('/ventas', [VentaController::class, 'index'])->middleware('permission:ventas.ver')->name('ventas.index');
    Route::get('/ventas/create', [VentaController::class, 'create'])->middleware('permission:ventas.crear')->name('ventas.create');
    Route::post('/ventas', [VentaController::class, 'store'])->middleware('permission:ventas.crear')->name('ventas.store');
    Route::get('/ventas/{venta}', [VentaController::class, 'show'])->middleware('permission:ventas.ver')->name('ventas.show');
    Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->middleware('permission:ventas.eliminar')->name('ventas.destroy');

    Route::get('/movimientos-stock', [MovimientoStockController::class, 'index'])->middleware('permission:movimientos-stock.ver')->name('movimientos-stock.index');
    Route::get('/movimientos-stock/{movimientoStock}', [MovimientoStockController::class, 'show'])->middleware('permission:movimientos-stock.ver')->name('movimientos-stock.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
