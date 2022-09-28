<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontController::class)->group(function () {
    Route::get('/', 'index');
});
