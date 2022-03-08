<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait IsLocalizable
{
    public function scopeLocalized(Builder $builder): Builder
    {
        return $builder->whereJsonContains('locales', app()->currentLocale());
    }
}
