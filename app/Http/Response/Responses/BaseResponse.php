<?php

namespace App\Http\Response\Responses;

use Illuminate\Contracts\View\View;

abstract class BaseResponse
{
    abstract public function handle(): View;

    abstract public function canHandleSlug(string $slug): bool;
}
