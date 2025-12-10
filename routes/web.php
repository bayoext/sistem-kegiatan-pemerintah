<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UserController;

// Beranda publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');

// Program publik
Route::get('/program', [ProgramController::class, 'publicIndex'])->name('programs.public');
Route::get('/program/{program}', [ProgramController::class, 'publicShow'])->name('programs.public.show');

// Authentication
require __DIR__.'/auth.php';

// Route yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Programs Resource
    Route::resource('programs', ProgramController::class)->except(['show']);
    Route::get('programs/{program}/show', [ProgramController::class, 'show'])->name('programs.show');
    
    // Categories Resource
    Route::resource('categories', CategoryController::class);
    
    // User Management (hanya superadmin)
    Route::middleware(['can:manage-users'])->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
    });
});