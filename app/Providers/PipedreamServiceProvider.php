<?php

namespace App\Providers;

use App\Services\Pipedream\PipedreamClient;
use Illuminate\Support\ServiceProvider;

class PipedreamServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PipedreamClient::class, function ($app) {
            return new PipedreamClient(
                clientId: config('services.pipedream.client_id'),
                clientSecret: config('services.pipedream.client_secret'),
                projectId: config('services.pipedream.project_id'),
                environment: config('services.pipedream.environment')
            );
        });
    }

    public function boot()
    {
        // Optional: Register routes or commands related to Pipedream here
    }
}
