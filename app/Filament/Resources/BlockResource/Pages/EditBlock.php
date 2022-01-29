<?php

namespace App\Filament\Resources\BlockResource\Pages;

use App\Filament\Resources\BlockResource;
use Filament\Resources\Pages\EditRecord;

class EditBlock extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = BlockResource::class;
}
