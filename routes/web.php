<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\juegoController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\CategoriaController;
Route::get('/', function () {
    return view('home');
});
Route::get('/ProyectoTienda', function () {
    return view('home');
});
Route::get('/dashboard', [CategoriaController::class, 'list'])->name('dash');
Route::get('/videojuegos',[juegoController::class,'list'])->name('videojuegos');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Livewire::setUpdateRoute(function($handle) {
    return Route::post('/ProyectoTienda/public/livewire/update', $handle);
});
Route::get('/plataformas/{plataforma}', [juegoController::class, 'porPlataforma'])->name('filtros');
Route::get('/categorias/{categoria}', [juegoController::class, 'porCategoria'])->name('filtros');