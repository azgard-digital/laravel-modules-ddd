<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api'], 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
});
