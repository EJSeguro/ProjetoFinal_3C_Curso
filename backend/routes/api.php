<?php

use App\Http\Controllers\AcademicBackgroundController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum', 'role:candidate'])->group(function () {
    Route::prefix('candidate')->group(function () {
        Route::post('/application', [ApplicationController::class, 'store']);
        Route::delete('/application/{id}', [ApplicationController::class, 'destroy']);
        Route::get('/applications', [ApplicationController::class, 'getCandidateApplications']);

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
});

Route::middleware(['auth:sanctum', 'role:recruiter'])->group(function () {
    Route::prefix('recruiter')->group(function () {
        Route::post('/vacancy', [VacancyController::class, 'store']);
        Route::delete('/vacancy/{id}', [VacancyController::class, 'destroy']);
        Route::put('/vacancy/{id}', [VacancyController::class, 'update']);
        Route::get('/vacancies', [VacancyController::class, 'recruiterVacancies']);

        Route::get('/applications', [ApplicationController::class, 'getAllApplicationsFromAllVacancies']);
        Route::get('/applications/{id}', [ApplicationController::class, 'getApplicationsFromVacancy']);
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/profile', [UserController::class, 'deleteProfile']);
    Route::put('/profile', [UserController::class, 'update']);
    Route::get('/profile', [UserController::class, 'indexProfile']);
    Route::get('/profile/{id}', [UserController::class, 'show']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::put('/changeRole', [UserController::class, 'changeRole']);

    Route::get('/vacancies', [VacancyController::class, 'index']);
    Route::get('/vacancy/{id}', [VacancyController::class, 'show']);

    Route::post('/uploadImage', [ImageController::class, 'upload']);
    Route::get('/images/{type}/{id}', [ImageController::class, 'getImage']);
});
