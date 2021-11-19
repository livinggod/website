<?php

namespace App\Extensions\Locale;

use Illuminate\Support\Carbon;

class Locale
{
    public static function parse(Carbon $date = null, string $format = null): string
    {
        if ($date === null) {
            $date = now()->subDay();
        }

        return LocaleDateFactory::create()->render($date, $format);
    }
}
