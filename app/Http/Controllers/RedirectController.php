<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Quintenbuis\Localization\Locale;

class RedirectController extends Controller
{
    public function __invoke(Request $request, string $lang = '/', ?string $slug = '/'): View|RedirectResponse
    {
        session()->remove('active');

        $locale = new Locale();

        if ($locale->isDefault($lang)) {
            return redirect(rtrim(config('app.url'), '/') . '/' . $slug);
        }

        if (! $locale->isCurrent($lang) && $locale->isSupported($lang)) {
            $locale->set($lang);
        }

        if (! $locale->isCurrent($lang) && ! $locale->isSupported($lang)) {
            $slug = $lang;
        }

        $response = ResponseFactory::createFromSlug($slug);

        return $response->handle();
    }
}
