<?php

namespace App\Extensions\Locale\Renderers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class ENRenderer extends BaseRenderer
{
    protected string $format = 'F jS Y';

    public function canRender()
    {
        return App::currentLocale() === 'en';
    }
}
