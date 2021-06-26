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

        $scheme = (explode('://', config('app.url'))[0] ?? 'http') . '://';

        $domain = $scheme . $locale . '.' . config('app.base_domain');

        if ($locale === config('localization.default_locale')) {
            $domain = config('app.url');
        }

        return rtrim($domain, '/') . '/' . $path;
    }
}
