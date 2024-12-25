<?php

namespace App\Providers;

use App\Helpers\Breadcrumbs;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        Inertia::share('breadcrumbs', function () {
        return request()->route()
            ? Breadcrumbs::generate(request()->route()->getName(), request()->route()->parameters())
            : [];
    });
    }
}
