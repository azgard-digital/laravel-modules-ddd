<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['api', 'auth']], function () {
    Route::resource('transactions', 'TransactionsController');
});
