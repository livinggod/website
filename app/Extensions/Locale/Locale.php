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
}
