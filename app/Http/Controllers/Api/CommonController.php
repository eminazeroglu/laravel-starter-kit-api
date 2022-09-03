<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Services\Models\MenuService;
use App\Services\Models\SeoMetaTagService;
use App\Services\Models\SettingService;

class CommonController extends Controller
{
    public function start(SettingService $settingService, MenuService $menuService): \Illuminate\Http\JsonResponse
    {
        $data      = $settingService->getLogo();
        $menus     = $menuService->findAll();
        $languages = Language::query()->with('translates')->active()->get();
        $result    = [
            'photos' => [
                'admin_logo_dark' => url('uploads/photos/setting/' . @$data['value']['admin_logo_dark'] ?? 'default_photo.webp'),
                'admin_logo_light' => url('uploads/photos/setting/' . @$data['value']['admin_logo_light'] ?? 'default_photo.webp'),
                'default_photo' => url('uploads/photos/setting/default_photo.webp'),
                'default_user' => url('uploads/photos/setting/default_user.webp'),
            ],
            'language' => helper()->language(),
            'languages' => $languages
        ];
        return response()->json($result);
    }

    public function seo(SeoMetaTagService $seoMetaTagService, $link = null): \Illuminate\Http\JsonResponse
    {
        $data = $seoMetaTagService->findByUrl('/' . $link);
        return response()->json($data);
    }
}
