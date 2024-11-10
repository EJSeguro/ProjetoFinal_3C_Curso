<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccacionController;
use Illuminate\Support\Facades\Route;


Route::post('/login',[AuthController::class, 'login']);
Route::post('/register', [AuthController::class,'register']);

Route::middleware(['auth:sanctum', 'role:candidate'])->group(function(){
    Route::post('/application',[ApplicationController::class,'storeApplication']);
    Route::delete('/application/{id}',[ApplicationController::class,'removeApplication']);
    Route::get('/application',[ApplicationController::class, 'indexApplication']);
    Route::get('/application/{id}',[ApplicationController::class, 'showApplication']);
});

Route::middleware(['auth:sanctum', 'role:recruiter'])->group(function(){
    Route::post('/vaccacion',[VaccacionController::class,'storeVaccacion']);
    Route::delete('/vaccacion/{id}',[VaccacionController::class,'removeVaccacion']);
    Route::put('/vaccacion/{id}', [VaccacionController::class,'updateVaccacion']);
    Route::get('/vaccacion',[VaccacionController::class, 'indexVaccacion']);
    Route::get('/vaccacion/{id}',[VaccacionController::class, 'showVaccacion']);
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::delete('/profile/{id}',[UserController::class,'deleteProfile']);
    Route::put('/profile/{id}', [UserController::class,'updateProfile']);
    Route::get('/profile',[UserController::class, 'indexProfile']);
    Route::get('/profile/{id}',[UserController::class, 'showProfile']);

    Route::post('/logout', [AuthController::class,'logout']);
});

// TODO:Terminar rotas
