<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Concerns\Create\HasTranslatableContent;
use App\Filament\Resources\PageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    use HasTranslatableContent;

    protected static string $resource = PageResource::class;
}
