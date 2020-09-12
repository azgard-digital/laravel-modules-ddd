<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api']], function () {
    Route::resource('users', 'UsersController');
});
