<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors', 'auth', 'json.response'], 'prefix' => 'api'], function () {
    Route::get('/flow/blocks', function () {
        return [];
    });
});
