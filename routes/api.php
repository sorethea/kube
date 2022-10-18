<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('users', App\Http\Controllers\API\UserAPIController::class)
        ->except(['create', 'edit']);
});

Route::post('login', '\App\Http\Controllers\API\UserAPIController@login');
Route::post('register', '\App\Http\Controllers\API\UserAPIController@register');


