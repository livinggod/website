<?php

namespace App\Filament\Resources;

use App\Filament\Cards\TimestampCard;
use App\Filament\Resources\TopicResource\Pages;
use App\Models\Topic;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class TopicResource extends Resource
{
    use Translatable;

    protected static ?string $model = Topic::class;

    protected static ?string $slug = 'blog/topics';

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->columns(3)
            ->schema([
                Forms\Components\Group::make()
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\Card::make()
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('slug')
                                    ->disabled(fn ($record) => ! is_null($record))
                                    ->helperText(__("Can't be changed later after creating"))
                                    ->required()
                                    ->prefix(config('app.url').'/')
                                    ->maxLength(255)
                                    ->unique(Topic::class, 'slug', fn ($record) => $record),
                                Forms\Components\Textarea::make('description')
                                    ->columnSpan(2),
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
                Tables\Columns\TextColumn::make('name'),
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
            'index'  => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit'   => Pages\EditTopic::route('/{record}/edit'),
        ];
    }
}
