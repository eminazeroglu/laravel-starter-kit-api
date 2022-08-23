<?php

use App\Http\Controllers\Api\CommonController;
use Illuminate\Support\Facades\Route;

Route::controller(CommonController::class)->prefix('common')->group(function () {
    Route::get('/start', 'start')->name('start');
    Route::get('/seo/{link?}', 'seo')->name('seo');
});
