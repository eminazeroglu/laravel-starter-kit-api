<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontController::class)->as('web.')->group(function () {
    Route::get('/', 'index')->name('index');
});
