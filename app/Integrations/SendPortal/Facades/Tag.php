<?php

namespace App\Integrations\SendPortal\Facades;

use App\Integrations\SendPortal\Tag as TagClass;
use Illuminate\Support\Facades\Facade;

class Tag extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TagClass::class;
    }
}
