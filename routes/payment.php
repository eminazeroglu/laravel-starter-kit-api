<?php
use Illuminate\Support\Facades\Route;

Route::post('delivery', [\App\Services\Payment\PulPalService::class, 'delivery'])->name('delivery');
Route::post('redirect', [\App\Services\Payment\PulPalService::class, 'redirect'])->name('redirect');
