<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Concerns\Create\HasTranslatableContent;
use App\Filament\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    use HasTranslatableContent;

    protected static string $resource = PostResource::class;
}
