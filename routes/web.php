<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizDtlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('demo');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');


    Route::middleware('admin.auth')->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('quiz', QuizDtlController::class);

        Route::post('/quiz/toggle-status', [QuizDtlController::class, 'toggleStatus'])->name('quiz.toggleStatus');

        Route::resource('questions', QuestionController::class);

    });
});


