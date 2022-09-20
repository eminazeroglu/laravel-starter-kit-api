<?php

use App\Http\Controllers\Api\FileManagementController;
use Illuminate\Support\Facades\Route;

Route::controller(FileManagementController::class)->group(function () {
    /*
     * Photo
     * */
    Route::prefix('photo')->as('photo.')->group(function () {
        Route::post('upload', 'photoUpload')->name('upload');
        Route::post('remove', 'photoRemove')->name('remove');
        Route::post('remove-all', 'photoRemoveAll')->name('remove-all');
        Route::post('editor-upload', 'editorPhotoUpload')->name('editor-upload');
    });
});
