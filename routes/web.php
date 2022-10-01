<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Web\PageController::class)->as('web.')->group(function () {
    try {
        $routes = (new \App\Services\Models\MenuService())->webRoutes();
        foreach ($routes as $route):
            $controller = helper()->menuRemoveParams($route['controller']);
            Route::get($route['route'], $controller)->name($controller);
        endforeach;
    }
    catch (Exception) {

    }
});
