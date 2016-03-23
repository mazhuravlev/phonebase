<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => ['web'],
        'domain' => env('APP_DOMAIN')
    ],
    function () {
        Route::get('/', 'PhoneController@index');
        Route::get('/{phoneNumber}', 'PhoneController@phone');
        Route::post('/search', 'PhoneController@search');
    }
);

Route::group(
    [
        'middleware' => ['web'],
        'domain' => '{subdomain}.' . env('APP_DOMAIN')
    ],
    function () {
        Route::get('/', 'PhoneController@phone');
    }
);
