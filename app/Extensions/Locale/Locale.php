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

        $domain = ltrim(config('app.url'), 'http://');
        $domain = ltrim(config('app.url'), 'https://');

        return request()->getScheme() . '://' . $locale . '.' . rtrim($domain, '/') . '/' . $path;
    }
}
