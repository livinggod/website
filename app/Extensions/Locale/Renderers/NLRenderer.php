<?php

namespace App\Extensions\Locale\Renderers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class NLRenderer extends BaseRenderer
{
    protected string $format = 'j F Y';

    public function canRender()
    {
        return App::currentLocale() === 'nl';
    }
}
