<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

trait IsLocalizable
{
    public function scopeLocalized(Builder $builder): Builder
    {
        return $builder->where('locales->' . App::currentLocale(), true);
    }
}