<?php

namespace App\Extensions\Locale\Renderers;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class ENRenderer extends BaseRenderer
{
    protected string $format = 'F jS Y';

    public function canRender(): bool
    {
        return App::currentLocale() === 'en';
    }
}
