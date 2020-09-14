<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'auth']], function () {
    Route::get('wallets/{address}/transactions','WalletsController@transactions');
    Route::resource('wallets', 'WalletsController');
});
