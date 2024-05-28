<?php

use Illuminate\Support\Facades\Route;

// Route::statamic('example', 'example-view', [
//    'title' => 'Example'
// ]);

//Route::get('/get-films', 'App\Http\Controllers\ApiController@get');

Route::post('/members/authenticate', 'App\Http\Controllers\LoginController@authenticate');

Route::post('/logout', 'App\Http\Controllers\LoginController@logout');