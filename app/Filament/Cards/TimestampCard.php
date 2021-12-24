<?php

namespace App\Filament\Cards;


use Filament\Forms\Components\Card;
use Filament\Forms\Components\Placeholder;

class TimestampCard
{
    public static function make(): Card
    {
        return Card::make()
            ->schema([
                Placeholder::make('created_at')
                    ->label('Created at')
                    ->content(fn ($record): string => $record ? $record->created_at->diffForHumans() : '-'),
                Placeholder::make('updated_at')
                    ->label('Last modified at')
                    ->content(fn ($record): string => $record ? $record->updated_at->diffForHumans() : '-'),
            ]);
    }
}
