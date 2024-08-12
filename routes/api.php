<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\categoryController;
use App\Http\Controllers\Api\productController;
use App\Http\Controllers\Api\platformController;

//Api de categorias
Route::get('/categories', [categoryController::class,'index']);

Route::get('/categories/{id}',[categoryController::class,'show']);

Route::post('/categories', [categoryController::class,'store']);

Route::put('/categories/{id}', [categoryController::class,'update']);

Route::patch('/categories/{id}', [categoryController::class,'updatePartial']);

Route::delete('categories/{id}',[categoryController::class,'destroy']);

//Api de plataformas
Route::get('/platforms', [platformController::class,'index']);

Route::get('/platforms/{id}',[platformController::class,'show']);

Route::post('/platforms', [platformController::class,'store']);

Route::put('/platforms/{id}', [platformController::class,'update']);

Route::patch('/platforms/{id}', [platformController::class,'updatePartial']);

Route::delete('platforms/{id}',[platformController::class,'destroy']);

//Api de productos
Route::get('/products', [productController::class,'index']);

Route::get('/products/{id}',[productController::class,'show']);

Route::post('/products', [productController::class,'store']);

Route::put('/products/{id}', [productController::class,'update']);

Route::patch('/products/{id}', [productController::class,'updatePartial']);

Route::delete('products/{id}',[productController::class,'destroy']);