<?php

use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

Route::controller(PageController::class)->as('web.')->group(function () {
    Route::get('/', 'index')->name('index');
});
