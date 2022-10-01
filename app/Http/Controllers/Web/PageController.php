<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

class PageController extends Controller
{
    public null|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model $currentRoute;
    public array                                                                          $breadcrumb;

    public function __construct()
    {
        $current            = str_replace('App\Http\Controllers\Web\PageController@', '', Route::currentRouteAction());
        $mainPage           = Menu::query()->active()->where('link', '/')->first();
        $this->currentRoute = Menu::query()->active()->where('link', 'like', '/' . $current . '%')->first();

        if ($this->currentRoute):
            $this->breadcrumb = [
                ['name' => $mainPage->name, 'link' => $mainPage->link],
                ['name' => $this->currentRoute->name],
            ];
        endif;
    }

    public function index()
    {
        return view('pages.index');
    }
}
