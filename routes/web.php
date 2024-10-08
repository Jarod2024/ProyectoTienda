<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\juegoController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HistorialController;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ProyectoTienda', function () {
    return view('home');
});

Route::get('/videojuegos',[DashController::class,'index'])->name('videojuegos');

Route::get('/dashboard', function () {
    return redirect()->route('videojuegos');
});

Auth::routes();


Livewire::setUpdateRoute(function($handle) {
    return Route::post('/juegos/public/livewire/update', $handle);
});


// Ruta de home accesible para todos los usuarios autenticados
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Ruta de perfil accesible para todos los usuarios autenticados
Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');

// Rutas solo accesibles para administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Aquí añades todas las rutas que solo los administradores pueden acceder
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Añade más rutas aquí...
});

// Rutas accesibles para empleados
Route::middleware(['auth', 'role:employee'])->group(function () {
    // Aquí añades todas las rutas que solo los empleados pueden acceder
    Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
    // Añade más rutas aquí...
});

// Rutas accesibles para usuarios
Route::middleware(['auth', 'role:user'])->group(function () {
    // Aquí añades todas las rutas que solo los usuarios pueden acceder
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    // Añade más rutas aquí...
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// routes/web.php

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('/plataformas/{plataforma}', [juegoController::class, 'porPlataforma'])->name('filtros');
Route::get('/categorias/{categoria}', [juegoController::class, 'porCategoria'])->name('filtros');


//restablecimiento de contraseña estén habilitadas
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/plataformas/{plataforma}', [juegoController::class, 'porPlataforma'])->name('filtros');
Route::get('/categorias/{categoria}', [juegoController::class, 'porCategoria'])->name('filtros');

// routes/web.php
Route::post('/orden/generar', [OrdenController::class, 'generarOrden'])->name('generar');
Route::get('/orden/{carrito_id}', [OrdenController::class, 'mostrarOrden'])->name('mostrar');
Route::get('/orden/{carrito_id}/descargar', [PDFController::class, 'generarPdf'])->name('descargar');
Route::post('/comprobante', [OrdenController::class, 'Store'])->name('comprobante');
Route::get('/historial', [HistorialController::class, 'mostrarHistorial'])->name('historial');
Route::get('/descargas', [PDFController::class, 'mostrarHistorial'])->name('comprobantes');
