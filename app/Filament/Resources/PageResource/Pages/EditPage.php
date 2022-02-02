<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditPage extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['content'] = [$this->activeFormLocale => $data['content']];

        $data['url'] = Str::slug($data['url']);

        return $data;
    }

    public function save(bool $shouldRedirect = true): void
    {
        parent::save($shouldRedirect);

        $this->fillForm();
    }
}
