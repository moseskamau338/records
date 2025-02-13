<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Inertia\Inertia;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class
])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    })->name('tenant.home');

    Route::middleware(['auth', 'verified'])->group(function () {
        Route::post('/teams', [\App\Http\Controllers\TeamController::class, 'store'])->name('team.store');

        Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');

        Route::get('/projects/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create');

        Route::get('/projects/{id}', [\App\Http\Controllers\ProjectController::class, 'view'])->name('projects.view');

        Route::get('/projects/{id}/flow', [\App\Http\Controllers\ProjectController::class, 'flow'])->name('projects.flow');

        Route::get('/projects/{id}/recon-stories', [\App\Http\Controllers\ProjectController::class, 'stories'])->name('projects.stories');

        Route::get('/connections', [\App\Http\Controllers\IntegrationsController::class, 'showConnections'])->name('connections.index');

        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // Integrations
        Route::post('/integrations/connect', [\App\Http\Controllers\IntegrationsController::class, 'initializeConnection']);

        Route::get('/integrations/accounts', [\App\Http\Controllers\IntegrationsController::class, 'getAccounts']);
        Route::get('/integrations/{app}/{account_id}/folders', [\App\Http\Controllers\IntegrationsController::class, 'getIntegrationFolders']);

        Route::post('/hot-folder/store', [\App\Http\Controllers\TenantHotFolderController::class, 'store']);
//         Route::get('/integrations/hot-folder/files', [\App\Http\Controllers\IntegrationsController::class, 'getIntegrationFolders']);

    });


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

//    Authentication
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });
    Route::middleware('auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});
