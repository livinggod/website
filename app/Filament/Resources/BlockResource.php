<?php

namespace App\Filament\Resources;

use App\Filament\Cards\TimestampCard;
use App\Filament\Resources\BlockResource\Pages;
use App\Filament\Resources\BlockResource\RelationManagers;
use App\Models\Block;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class BlockResource extends Resource
{
    use Translatable;

    protected static ?string $model = Block::class;
    protected static ?string $slug = 'content/blocks';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\TextInput::make('code')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\MarkdownEditor::make('content')
                                    ->required(),
                            ]),
                    ]),
                Forms\Components\Group::make()
                    ->columnSpan(1)
                    ->schema([
                        TimestampCard::make(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlocks::route('/'),
            'create' => Pages\CreateBlock::route('/create'),
            'edit' => Pages\EditBlock::route('/{record}/edit'),
        ];
    }
}
