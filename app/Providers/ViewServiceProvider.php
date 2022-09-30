<?php

namespace App\Providers;

use App\Services\Models\MenuService;
use App\Services\Models\SettingService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer([
            'components.common.header',
            'components.common.footer',
            'components.common.navbar',
        ], function ($view) {
            $settingService = new SettingService();
            $photos         = $settingService->getLogo();
            $general        = $settingService->getGeneral();
            $social_pages   = $settingService->getSocialPage();
            $menus          = (new MenuService())->findAll();
            $whatsapp_phone = collect($general['value']['phones'])->where('whatsapp', true)->first();
            $view->with([
                'photos'         => $photos['value'],
                'whatsapp_phone' => $whatsapp_phone,
                'general'        => $general['value'],
                'header_menus'   => $menus->where('type', 'header'),
                'social_pages'   => $social_pages['value']
            ]);
        });
    }
}
