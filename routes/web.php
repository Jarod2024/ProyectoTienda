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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
// routes/web.php

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Livewire::setUpdateRoute(function($handle) {
    return Route::post('/ProyectoTienda/public/livewire/update', $handle);
});
Route::get('/plataformas/{plataforma}', [juegoController::class, 'porPlataforma'])->name('filtros');
Route::get('/categorias/{categoria}', [juegoController::class, 'porCategoria'])->name('filtros');