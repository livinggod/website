<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Concerns\Edit\HasTranslatableContent;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    use HasTranslatableContent;

    protected static string $resource = PostResource::class;
}
