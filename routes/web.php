<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ProfileController as ControllersProfileController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ControllersProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ControllersProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ControllersProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(Admin::class)->prefix('admin')->name('admin.')->group(function () {
        Route::resource('tags', TagController::class);
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::resource('profiles', ProfileController::class);
    });
});

require __DIR__.'/auth.php';
