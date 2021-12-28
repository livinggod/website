<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Concerns\Edit\HasTranslatableContent;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Str;

class EditPage extends EditRecord
{
    use HasTranslatableContent;

    protected static string $resource = PageResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['url'] = Str::slug($data['url']);
        return $data;
    }
}
