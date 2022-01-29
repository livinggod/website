<?php

namespace App\Filament\Resources\BlockResource\Pages;

use App\Filament\Resources\BlockResource;
use Filament\Resources\Pages\ListRecords;

class ListBlocks extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = BlockResource::class;
}
