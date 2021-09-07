<?php

namespace App\Integrations\SendPortal\Facades;

use App\Integrations\SendPortal\Subscriber as SubscriberClass;
use Illuminate\Support\Facades\Facade;

class Subscriber extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SubscriberClass::class;
    }
}
