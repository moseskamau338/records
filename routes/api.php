<?php

use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::group(['middleware' => ['cors', 'auth', 'json.response'], 'prefix' => 'api'], function () {
            Route::get('/flow/blocks', function () {
                return [];
            });
        });
    });
}
