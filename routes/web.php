<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return Inertia::render('Welcome', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        })->middleware(['web'])->name('home');

        Route::get('/register', [\App\Http\Controllers\RegisteredTenantController::class, 'create'])->name('register.show');
        Route::post('/register', [\App\Http\Controllers\RegisteredTenantController::class, 'store'])->name('register.store');
    });
}
