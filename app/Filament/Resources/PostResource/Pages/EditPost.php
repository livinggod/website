<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return tap($data, fn (&$data) => $data['content'] = [$this->activeFormLocale => $data['content']]);
    }

    public function save(bool $shouldRedirect = true): void
    {
        parent::save($shouldRedirect);

        $this->fillForm();
    }
}
