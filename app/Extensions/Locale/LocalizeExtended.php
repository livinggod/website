<?php

namespace App\Extensions\Locale;

use Closure;
use Illuminate\Http\Request;
use Quintenbuis\Localization\Facades\Locale;
use Quintenbuis\Localization\Middleware\Localize;

class LocalizeExtended extends Localize
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('nova*')) {
            return $next($request);
        }

        if (! $this->hasSubdomain($request)) {
            Locale::setDefault();

            return $next($request);
        }

        $locale = Locale::get($request);

        if (Locale::isDefault($locale)) {
            return $this->redirectToMainDomain($request, $locale);
        }

        if (Locale::isCurrent($locale)) {
            return $next($request);
        }

        if (! Locale::isSupported($locale)) {
            return $this->redirectToMainDomain($request, $locale);
        }

        Locale::set($locale);

        return $next($request);
    }
}
