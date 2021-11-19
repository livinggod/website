<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class Localize
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->is('nova*')) {
            app()->setLocale(
                cache()->get(optional(auth())->id().'.locale') ?? App::currentLocale()
            );
        } else {
            app()->setLocale(
                collect(config('localization.allowed_locales'))
                    ->where('domain', $request->getSchemeAndHttpHost())
                    ->keys()
                    ->first()
            );
        }

        return $next($request);
    }
}
