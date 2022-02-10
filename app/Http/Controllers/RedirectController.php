<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __invoke(Request $request, ?string $slug = '/'): View|RedirectResponse
    {

        session()->remove('active');

        $baseResponse = ResponseFactory::createFromSlug($slug);

        return $baseResponse->handle();
    }
}
