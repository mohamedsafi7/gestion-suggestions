<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/add', function () {
    return view('add_suggestion');
})->name('add_suggestion');

// Guest-only Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/suggestions', [SuggestionController::class, 'Add'])->name('suggestions.add');
    Route::get('/home', [SuggestionController::class, 'getSuggestion'])->name('getSuggestion');
    Route::patch('/suggestions/{suggestion}/status', [SuggestionController::class, 'updateStatus'])->name('suggestions.updateStatus');

    // Suggestion Routes
    Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');
    Route::delete('/suggestions/{id}', [SuggestionController::class, 'destroy'])->name('suggestion.delete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Shared Logout Route
Route::post('/logout', [UserController::class, 'destroy'])->name('logout');
