<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizDtlController;
use App\Http\Controllers\user_QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;

// welcome route
Route::get('/', function () {
    return view('welcome');
})->name('demo');



// admin routes
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


//user routes
Route::get('/{slug}', [user_QuizController::class, 'quiz_dtl'])->name('quiz.details');
Route::post('/details', [user_QuizController::class, 'storeUserDetails'])->name('user.details.store');


Route::get('/quiz/{slug}', [user_QuizController::class, 'quizStartPage'])
    ->name('quiz.start')
    ->middleware('ensure.user.details');

