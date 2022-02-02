<?php

namespace App\Filament\CustomFields;

use Filament\Forms\Components\CheckboxList;

class LocaleCheckbox
{
    public static function make(): CheckboxList
    {
        return CheckboxList::make('locales')->options(
            collect(array_keys(config('localization.allowed_locales')))->mapWithKeys(fn ($locale) => [$locale => $locale])->toArray()
        );
    }
}
