<?php

use App\Http\Controllers\AcademicBackgroundController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum', 'role:candidate'])->group(function () {
    Route::post('/application', [ApplicationController::class, 'storeApplication']);
    Route::delete('/application/{id}', [ApplicationController::class, 'removeApplication']);
    Route::get('/application', [ApplicationController::class, 'indexApplication']);
    Route::get('/application/{id}', [ApplicationController::class, 'showApplication']);

    Route::post('/application', [ApplicationController::class, 'store']);
    Route::delete('/application', [ApplicationController::class, 'destroy']);
    Route::get('/application', [ApplicationController::class, 'indexApplicationsCandidate']);

    Route::post('/academicBackground', [AcademicBackgroundController::class, 'store']);
    Route::delete('/academicBackground/{academicBackground}', [AcademicBackgroundController::class, 'destroy']);
    Route::put('/academicBackground/{academicBackground}', [AcademicBackgroundController::class, 'update']);
    Route::get('/academicBackground/{id}', [AcademicBackgroundController::class, 'index']);
    Route::get('/academicBackground/{academicBackground}', [AcademicBackgroundController::class, 'show']);

    Route::post('/experience', [ExperienceController::class, 'store']);
    Route::delete('/experience/{experience}', [ExperienceController::class, 'destroy']);
    Route::put('/experience/{experience}', [ExperienceController::class, 'update']);
    Route::get('/experience/{id}', [ExperienceController::class, 'index']);
    Route::get('/experience/{experience}', [ExperienceController::class, 'show']);
});

Route::middleware(['auth:sanctum', 'role:recruiter'])->group(function () {
    Route::post('/vaccacion', [VacancyController::class, 'store']);
    Route::delete('/vaccacion/{id}', [VacancyController::class, 'destroy']);
    Route::put('/vaccacion/{id}', [VacancyController::class, 'update']);

    Route::get('/applications', [ApplicationController::class, 'indexApplicationsAll']);
    Route::get('/applications/{id}', [ApplicationController::class, 'indexApplicationsVacancy']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/profile', [UserController::class, 'deleteProfile']);
    Route::put('/profile/{id}', [UserController::class, 'updateProfile']);
    Route::get('/profile', [UserController::class, 'indexProfile']);
    Route::get('/profile/{id}', [UserController::class, 'showProfile']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/changeRole', [UserController::class, 'changeRole']);

    Route::get('/vaccacion', [VacancyController::class, 'index']);
    Route::get('/vaccacion/{id}', [VacancyController::class, 'show']);
});

// TODO:Terminar rotas
