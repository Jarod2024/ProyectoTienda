<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\categoryController;

Route::get('/categories', [categoryController::class,'index']);

Route::get('/categories/{id}',[categoryController::class,'show']);

Route::post('/categories', [categoryController::class,'store']);

Route::put('/categories/{id}', [categoryController::class,'update']);

Route::patch('/categories/{id}', [categoryController::class,'updatePartial']);

Route::delete('categories/{id}',[categoryController::class,'destroy']);