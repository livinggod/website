<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RedirectSubdomainController
{
    public function __invoke(string $locale, string $url = ''): RedirectResponse
    {
        $domain = config("localization.allowed_locales.{$locale}.domain", config('app.url'));

        return Redirect::to("{$domain}/{$url}", 301);
    }
}
