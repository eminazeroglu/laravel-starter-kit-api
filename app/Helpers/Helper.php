<?php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Translate;
use App\Services\Models\SeoMetaTagService;
use App\Services\Models\SettingService;
use App\Services\System\ImageUploadService;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Helper
{
    /*
     * Language
     * */
    public function language()
    {
        $lang = request()->header('content-language') ?? 'az';
        if ($lang):
            return $lang;
        endif;
        return config('global.language');
    }

    /*
     * Model Translate
     * */
    public function modelTranslate($data, $value)
    {
        $lang = $this->language();
        $data = json_decode(json_encode($data), true);
        if (isset($data[$lang])) return $data[$lang][$value];
        return null;
    }

    /*
     * Create Slug
     * */
    public function createSlug($model, $text, $value = 'url')
    {
        $text  = str()->slug($text);
        $check = $model->select($value)->where($value, 'like', $text . '%');
        if ($check->exists()) return $text . '-' . $check->count();
        return $text;
    }

    /*
     * Short Url
     * */
    public function shortUrl($model, $field = 'short_url'): bool|string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $alphabet = str_split($alphabet);
        $number   = '1234567890';
        $number   = str_split($number);
        shuffle($alphabet);
        shuffle($number);
        $short = $alphabet[0] . $number[0] . $alphabet[1] . $number[1] . $alphabet[2] . $number[2] . $alphabet[3] . $number[3];
        if ($short):
            $check = $model->select($field)->where($field, $short)->first();
            if ($check) $this->shortUrl($model, $field);
            return $short;
        endif;
        return false;
    }

    /*
     * Cache
     * */
    public function cache($name, $callback)
    {
        $name = config('global.cache.' . $name);
        if ($name):
            return Cache::remember($name, env('CACHE_TIME'), function () use ($callback) {
                return call_user_func($callback);
            });
        endif;
        return false;
    }

    /*
     * Cache Remove
     * */
    public function cacheRemove($name): bool
    {
        $name = config('global.cache.' . $name);
        if ($name) Cache::forget($name);
        return false;
    }

    /*
     * Cache Clear All
     * */
    public function cacheClearAll(): bool
    {
        collect(config('global.cache'))->each(fn($val) => Cache::forget($val));
        return false;
    }

    /*
     * Translate
     * */
    public function translate($key = null, $search = null, $replace = null)
    {
        $translate = $this->cache('translates', fn() => Translate::query()->get(['lang', 'key', 'text']));
        if ($translate):
            if ($key):
                $translate = $translate->where('lang', $this->language())->where('key', $key)->first();
                if ($translate):
                    if ($search && $replace):
                        if ($search === ':label'):
                            $index = strpos($translate['text'], ':label');
                            return str_replace($search, $index > 0 ? mb_convert_case($this->translate($replace), MB_CASE_LOWER, 'UTF-8') : $this->translate($replace), $translate['text']);
                        endif;
                        return str_replace($search, $replace, $translate['text']);
                    endif;
                    return $translate['text'] ?: $key;
                endif;
            endif;
        endif;
        return $key;
    }

    /*
     * Language With Code
     * */
    public function languageWithCode()
    {
        return Language::query()->active()->pluck('code');
    }

    /*
     * File Get Content
     * */
    public function fileGetContent($url, $post = null): bool|string
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        if ($post):
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        endif;
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /*
     * EnCrypto
     * */
    public function enCrypto($text, $key = null): string
    {
        $result = '';
        $key    = md5($key ?? "$2y10vevajHjAnY0v#355pfz9O@eZn#PxtmJOEKXg#7EqJPZXyhH3hC5@804ni");
        for ($i = 0; $i < strlen($text); $i++):
            $char    = substr($text, $i, 1);
            $keyChar = substr($key, ($i % strlen($key)) - 1, 1);
            $char    = chr(ord($char) + ord($keyChar) + strlen(md5($key)));
            $result  .= $char;
        endfor;
        $return = urlencode(base64_encode($result));
        return Crypt::encryptString(strtr($return, "%", "_"));
    }

    /*
     * DeCrypto
     * */
    public function deCrypto($text, $key = null): string
    {
        $result = '';
        try {
            $key   = md5($key ?? "$2y10vevajHjAnY0v#355pfz9O@eZn#PxtmJOEKXg#7EqJPZXyhH3hC5@804ni");
            $value = Crypt::decryptString($text);
            $value = strtr($value, "_", "%");
            $value = base64_decode(urldecode($value));
            for ($i = 0; $i < strlen($value); $i++):
                $char    = substr($value, $i, 1);
                $keyChar = substr($key, ($i % strlen($key)) - 1, 1);
                $char    = chr(ord($char) - ord($keyChar) - strlen(md5($key)));
                $result  .= $char;
            endfor;
        }
        catch (DecryptException $e) {
            return $result;
        }
        return $result;
    }

    /*
     * Month By Code
     * */
    public function monthByCode($code, $length = 0)
    {
        $result = match ((int)$code) {
            1 => $this->translate('date.Month.January'),
            2 => $this->translate('date.Month.February'),
            3 => $this->translate('date.Month.March'),
            4 => $this->translate('date.Month.April'),
            5 => $this->translate('date.Month.May'),
            6 => $this->translate('date.Month.June'),
            7 => $this->translate('date.Month.July'),
            8 => $this->translate('date.Month.August'),
            9 => $this->translate('date.Month.September'),
            10 => $this->translate('date.Month.October'),
            11 => $this->translate('date.Month.November'),
            12 => $this->translate('date.Month.December'),
            default => null,
        };
        if ($length > 0):
            $result = str()->limit($result, $length, '');
        endif;
        return $result;
    }

    /*
     * Week By Code
     * */
    public function weekByCode($code): string
    {
        $result = match ($code) {
            1 => $this->translate('date.Week.Monday'),
            2 => $this->translate('date.Week.Tuesday'),
            3 => $this->translate('date.Week.Wednesday'),
            4 => $this->translate('date.Week.Thursday'),
            5 => $this->translate('date.Week.Friday'),
            6 => $this->translate('date.Week.Saturday'),
            0 => $this->translate('date.Week.Sunday'),
            default => '',
        };
        return @$result ? $result : '-';
    }

    /*
     * Date
     * */
    public function date($date, $format = 'month_string_with_clock', $length = null): Carbon|string
    {
        $result = $date = Carbon::createFromTimeString($date);
        $day    = $date->day;
        $month  = $date->month;
        $year   = $date->year;
        $clock  = ($date->hour < 10 ? '0' . $date->hour : $date->hour) . ':' . ($date->minute < 10 ? '0' . $date->minute : $date->minute);
        if ($format == 'string'):
            $nowDate = now();
            $difDate = $nowDate->day - $date->day;
            if ($difDate == 0)
                $result = $this->translate('date.Day.ToDay') . ', ' . $clock;
            else if ($difDate == 1)
                $result = $this->translate('date.Day.Yesterday') . ', ' . $clock;
            else
                $result = $day . ' ' . $this->monthByCode($month, $length) . ' ' . $year;
        elseif ($format == 'month_string'):
            $result = $day . ' ' . $this->monthByCode($month, $length) . ' ' . $year . ' ' . $clock;
        elseif ($format == 'month_string_with_clock'):
            $result = $day . ' ' . $this->monthByCode($month, $length) . ' ' . $year;
        elseif ($format):
            $result = $date->format($format);
        endif;
        return $result;
    }

    /*
     * File Size
     * */
    public function fileSize($path): string
    {
        $size  = filesize($path);
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    /*
     * Can
     * */
    public function can($key = null, $option = null)
    {
        $user = auth()->user();
        if ($user):
            if ($key && $option):
                $permission = $user->permissions->map(fn($i) => [
                    'key'    => $i->permission->key,
                    'option' => json_decode($i->option_field ?: '[]', true),
                ]);
                if ($permission->count() > 0):
                    if ($find = $permission->where('key', $key)->first()):
                        return @$find['option'][$option] ? $find['option'][$option] : false;
                    endif;
                endif;
                return false;
            else:
                return $user->permission_id;
            endif;
        endif;
        return false;
    }

    /*
     * Crypt String
     * */
    public function cryptString($text, $show = 1): string
    {
        return str($text)->mask('*', $show);
    }

    /*
     * Unique Number
     * */
    public function uniqueNumber($model, $limit = 6, $value = 'code'): string
    {
        $limit = $limit > 19 ? 17 : $limit;
        $text  = rand((int)(1 . str_repeat(0, $limit)), (int)(9 . str_repeat(9, $limit)));
        $check = $model->select($value)->where($value, $text);
        if ($check->exists())
            return $this->uniqueNumber($model, $limit, $value);
        return sprintf('%0' . $limit . 'd', str()->limit($text, $limit, ''));
    }

    /*
     * Generate Number
     * */
    public function generateNumber($limit = 6): string
    {
        $text = str_shuffle(abs(crc32(uniqid())) . time());
        return sprintf('%0' . $limit . 'd', str()->limit($text, $limit, ''));
    }

    /*
     * Multiple Photo
     * */
    public function multiplePhoto($photo, $path): array
    {
        $imageService = new ImageUploadService();
        $photoView =  $imageService->getPhoto($path, $photo);
        return [
            'uid'     => str_random(),
            'url'     => $photoView['thumbnail'] ?? $photoView['original'] ?? '',
            'preview' => $photoView['original'] ?? '',
            'value'   => $photo,
            'hash'    => $this->enCrypto(json_encode([
                'name' => $photo,
                'path' => $path
            ]))
        ];
    }

    /*
     * Price
     * */
    public function price($price): string
    {
        return (float)$price . '₼';
    }

    /*
     * Meta Tag
     * */
    public function metaTag($title = null, $description = null, $image = null, $keywords = null): string
    {
        $seo     = [];
        $mainSeo = [];
        if (!$title && !$description && !$keywords):
            $mainSeo = (new SeoMetaTagService())->getUrl('/');
            $seo     = (new SeoMetaTagService())->getUrl(request()->getRequestUri());
        endif;
        $setting     = collect(\App\Models\Setting::whereIn('key', ['general', 'html'])->get());
        $general     = $setting->where('key', 'general')->first();
        $html        = $setting->where('key', 'html')->first();
        $logo        = (new SettingService())->getLogo();
        $title       = ($title ? $title : optional($seo)->title) ?? optional($mainSeo)->title;
        $title       = str_limit(strip_tags($title), 60);
        $description = ($description ? $description : optional($seo)->decsription) ?? optional($mainSeo)->description;
        $description = str_limit(strip_tags($description), 155);
        $keywords    = ($keywords ? $keywords : optional($seo)->keywords) ?? optional($mainSeo)->keywords;
        $image       = $image ?? optional($logo['value'])['wallpaper_path'];
        $url         = $params['url'] ?? request()->fullUrl();
        $theme_color = $general->value['theme_color'] ?? null;
        $favicon     = optional($logo['value'])['favicon_path'];


        $result = '<title>' . $title . '</title>';
        $result .= '<link rel="icon" type="image/*" href="' . $favicon . '" sizes="30x30" />';
        $result .= '<link rel="image_src" href="' . $image . '" />';
        $result .= '<link rel="canonical" href="' . $url . '" />';
        $result .= '<meta name="description" content="' . $description . '" />';
        if ($keywords)
            $result .= '<meta name="keywords" content="' . $keywords . '" />';
        $result .= '<meta property="og:title" content="' . $title . '" />';
        $result .= '<meta property="og:url" content="' . $url . '" />';
        $result .= '<meta property="og:description" content="' . $description . '" />';
        $result .= '<meta property="og:image" content="' . $image . '" />';
        $result .= '<meta property="og:image:alt" content="' . $title . '" />';
        $result .= '<meta property="og:type" content="website" />';
        $result .= '<meta property="og:locale:locale" content="az_Az" />';
        $result .= '<meta property="og:site_name" content="' . request()->getHost() . '" />';
        $result .= '<meta property="twitter:title" content="' . $title . '" />';
        $result .= '<meta property="twitter:url" content="' . $url . '" />';
        $result .= '<meta property="twitter:description" content="' . $description . '" />';
        $result .= '<meta property="twitter:image" content="' . $image . '" />';
        $result .= '<meta property="twitter:card" content="summary_large_image" />';
        $result .= '<meta property="vk:title" content="' . $title . '" />';
        $result .= '<meta property="vk:description" content="' . $description . '" />';
        $result .= '<meta property="vk:image" content="' . $image . '" />';
        $result .= '<meta itemprop="name" content="' . $title . '" />';
        $result .= '<meta itemprop="description" content="' . $description . '" />';
        $result .= '<meta itemprop="image" content="' . $image . '" />';
        $result .= '<meta name="author" content="Emin Azeroglu | http://azerogluemin.com" />';
        $result .= '<meta name="theme-color" content="' . $theme_color . '" />';
        $result .= '<meta name="apple-mobile-web-app-capable" content="yes" />';
        $result .= '<meta name="apple-touch-fullscreen" content="yes" />';
        $result .= '<meta name="apple-mobile-web-app-status-bar-style" content="' . $theme_color . '" />';
        $result .= '<meta name="msapplication-navbutton-color" content="' . $theme_color . '" />';
        if (optional($seo)->robots)
            $result .= '<meta name="robots" content="' . optional($seo)->robots . '" />';
        if (optional($seo)->googlebot)
            $result .= '<meta name="googlebot" content="' . optional($seo)->googlebot . '" />';
        if (optional($seo)->yahoobot)
            $result .= '<meta name="yahoobot" content="' . optional($seo)->yahoobot . '" />';
        if (optional($seo)->alexabot)
            $result .= '<meta name="alexabot" content="' . optional($seo)->alexabot . '" />';
        if (optional($seo)->msnbot)
            $result .= '<meta name="msnbot" content="' . optional($seo)->msnbot . '" />';
        if (optional($seo)->dmozbot)
            $result .= '<meta name="dmozbot" content="' . optional($seo)->dmozbot . '" />';
        $result .= '<meta name="distribution" content="global" />';
        $result .= '<meta name="rating" content="General" />';
        $result .= '<meta name="language" content="Azerbaijani" />';
        $result .= '<meta name="MobileOptimized" content="width" />';
        $result .= '<meta name="HandheldFriendly" content="true" />';
        $result .= $html['value']['head'];
        return $result;
    }

    public function findDevice(bool $fullControl = false, bool $platform = false): bool|string
    {
        $device = new \Jenssegers\Agent\Agent();
        $result = 'desktop';

        if ($fullControl):
            if ($device->isMobile()):
                $result = 'mobile';
            elseif ($device->isTablet()):
                $result = 'tablet';
            elseif ($device->isPhone()):
                $result = $device->isPhone();
            elseif ($device->isRobot()):
                $result = 'robot';
            endif;

            if ($platform && $device->platform()):
                return $device->platform();
            endif;

        else:
            if ($device->isMobile()):
                $result = 'mobile';
            endif;
        endif;
        return $result;
    }

    public function socialShare($name, $text, $url = null, $media = null): string
    {
        $url    = @$url ? $url : request()->fullUrl();
        $result = '';
        switch ($name):
            case 'facebook':
                $result = 'https://www.facebook.com/sharer/sharer.php?u=' . $url;
                break;
            case 'twitter':
                $result = 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $text;
                break;
            case 'pinterest':
                $result = 'http://pinterest.com/pin/create/button/?url=' . $url . '&media=' . $media . '&description=' . $text;
                break;
            case 'linkedin':
                $result = 'http://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $text;
                break;
            case 'viber':
                $result = 'viber://forward?text=' . $url;
                break;
            case 'facebook_messenger':
                $result = 'fb-messenger://share/?link=' . $url;
                break;
            case 'whatsapp':
                if ($this->findDevice() == 'mobile'):
                    $result = 'whatsapp://send?text=' . $url;
                else:
                    $result = 'https://web.whatsapp.com/send?text=' . $url;
                endif;
                break;
            /* Whatsapp Send Message */
            case 'whatsapp_send_message':
                $result = 'https://wa.me/' . $text;
                break;
            /* Telegram */
            case 'telegram':
                if ($this->findDevice() == 'mobile'):
                    $result = 'tg://msg?text==' . $url;
                else:
                    $result = 'https://telegram.me/share/url?url=' . $url . '&text=' . $text;
                endif;
                break;
        endswitch;
        return $result;
    }

    public function paginateTemplate($items)
    {
        return $items->appends(request()->query())->links('components.ui.paginate.index');
    }

}
