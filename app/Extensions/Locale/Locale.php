<?php

namespace App\Extensions\Locale;

use Illuminate\Support\Carbon;
use Quintenbuis\Localization\Locale as BaseLocale;

class Locale extends BaseLocale
{
    public static function parse(Carbon $date, string $format = null): string
    {
        $renderer = LocaleDateFactory::create();

        return $renderer->render($date, $format);
    }

    public static function redirectToLocale(string $locale): string
    {
        if (($path = request()->path()) === '/') {
            $path = null;
        }

        $path = ltrim($path, $locale . '/');

        $domain = str_replace(config('app.base_domain'), $locale . '.' . config('app.base_domain'), config('app.url'));

        return rtrim($domain, '/') . '/' . $path;
    }
}
