<?php

namespace App\Extensions\Locale\Renderers;

use Illuminate\Support\Carbon;

abstract class BaseRenderer
{
    protected string $format;

    public function render(Carbon $date, string $format = null): string
    {
        return Carbon::parse($date)->translatedFormat($format ?? $this->format);
    }

    abstract public function canRender();
}
