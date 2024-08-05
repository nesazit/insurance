<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\InsuranceController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [InsuranceController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [ProfileController::class, 'userInformation'])->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
require __DIR__ . '/information.php';
