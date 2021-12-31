<?php

namespace App\Filament\Concerns\Create;

use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

trait HasTranslatableContent
{
    use Translatable;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return tap($data, fn (&$data) => $data['content'] = [$this->activeFormLocale => $data['content']]);
    }
}
