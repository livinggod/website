<?php

namespace App\Filament\Resources\BlockResource\Pages;

use App\Filament\Resources\BlockResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlock extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = BlockResource::class;
}
