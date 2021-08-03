<?php

namespace App\Http\Response\Responses;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

abstract class BaseResponse
{
    abstract public function handle(): View | RedirectResponse;

    abstract public function canHandleSlug(string $slug): bool;
}
