<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->middleware(['auth', 'verified'])->name('projects.index');

Route::get('/projects/{id}', [\App\Http\Controllers\ProjectController::class, 'view'])->middleware(['auth', 'verified'])->name('projects.view');

Route::get('/projects/{id}/flow', [\App\Http\Controllers\ProjectController::class, 'flow'])->middleware(['auth', 'verified'])->name('projects.flow');

Route::get('/projects/{id}/recon-stories', [\App\Http\Controllers\ProjectController::class, 'stories'])->middleware(['auth', 'verified'])->name('projects.stories');

Route::get('/templates', function () {
    return Inertia::render('Templates/Index');
})->middleware(['auth', 'verified'])->name('templates.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
