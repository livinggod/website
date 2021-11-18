<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('nova*')) {
            Carbon::setLocale(cache()->get(auth()?->id().'.locale') ?? App::currentLocale());
            app()->setLocale(cache()->get(auth()?->id().'.locale') ?? App::currentLocale());
        }

        return $next($request);
    }
}
