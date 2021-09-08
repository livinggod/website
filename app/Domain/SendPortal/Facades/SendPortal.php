<?php

namespace App\Domain\SendPortal\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array post(string $endpoint, array $data)
 * @method static array get(string $endpoint)
 */
class SendPortal extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sendportal';
    }
}
