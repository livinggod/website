<?php

namespace App\Filament\Resources;

use App\Filament\Cards\TimestampCard;
use App\Filament\CustomFields\LocaleCheckbox;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;
    protected static ?string $slug = 'content/pages';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationIcon = 'heroicon-o-document';

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
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required(),
                                        Forms\Components\TextInput::make('url')
                                            ->required()
                                            ->disabled(fn (?Page $record) => ! is_null($record))
                                            ->prefix(config('app.url').'/')
                                            ->maxLength(255)
                                            ->helperText(__("Can't be changed later after creating"))
                                            ->unique(Page::class, 'url', fn ($record) => $record),
                                    ]),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                            ->required()
                                            ->columnSpan(2)
                                            ->image(),
                                    ]),
                            ]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Builder::make('content')
                                    ->blocks([
                                        Forms\Components\Builder\Block::make('title')
                                            ->schema([
                                                Forms\Components\TextInput::make('title'),
                                            ]),
                                        Forms\Components\Builder\Block::make('paragraph')
                                            ->schema([
                                                Forms\Components\MarkdownEditor::make('content'),
                                            ]),
                                        Forms\Components\Builder\Block::make('youtube_video')
                                            ->schema([
                                                Forms\Components\TextInput::make('url'),
                                            ]),
                                    ]),
                            ]),
                    ]),

                Forms\Components\Group::make()
                    ->columnSpan(1)
                    ->schema([
                        TimestampCard::make(),
                        Forms\Components\Card::make()
                            ->schema([
                                LocaleCheckbox::make(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('url'),
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
            'index'  => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit'   => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
