<?php

namespace App\Http\Controllers;

use App\Http\Response\ResponseFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function __invoke(Request $request, ?string $slug = '/'): View
    {
        session()->remove('active');

        $response = ResponseFactory::createFromSlug($slug);

        return $response->handle();
    }
}
