<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\RobotsMiddleware\RobotsMiddleware;

class Robots extends RobotsMiddleware
{
    public function shouldIndex(Request $request): bool
    {
        return $request->segment(1) !== 'admin';
    }
}
