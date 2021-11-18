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
        ENRenderer::class,
    ];

    public static function create(): BaseRenderer
    {
        /** @var BaseRenderer $renderer */
        $renderer = collect(self::$localeHandlers)
                ->map(fn (string $renderer): object => new $renderer())
                ->filter(fn (BaseRenderer $renderer): bool => $renderer->canRender())
                ->first() ?? new self::$defaultRenderer();

        return $renderer;
    }
}
