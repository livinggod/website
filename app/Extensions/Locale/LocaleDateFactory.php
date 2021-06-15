<?php

namespace App\Extensions\Locale;

use App\Extensions\Locale\Renderers\BaseRenderer;
use App\Extensions\Locale\Renderers\ENRenderer;
use App\Extensions\Locale\Renderers\NLRenderer;

class LocaleDateFactory
{
    protected static string $defaultRenderer = ENRenderer::class;

    protected static array $localeHandlers = [
        NLRenderer::class,
        ENRenderer::class
    ];

    public static function create(): BaseRenderer
    {
        return collect(self::$localeHandlers)
            ->map(fn (string $renderer) => new $renderer())
            ->filter(fn (BaseRenderer $renderer) => $renderer->canRender())
            ->first() ?? new self::$defaultRenderer();
    }
}
