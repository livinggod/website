<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\Topic;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
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
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->columnSpan(2)
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                        Forms\Components\TextInput::make('slug')
                                            ->columnSpan(2)
                                            ->disabled()
                                            ->required()
                                            ->unique(Post::class, 'slug', fn ($record) => $record),
                                        Forms\Components\TextInput::make('description')
                                            ->columnSpan('full'),
                                    ]),
                            ]),
                        Forms\Components\Card::make()
                        ->schema([
                            Forms\Components\RichEditor::make('content')
                                ->required(),
                        ]),
                    ]),
                Forms\Components\Group::make()
                    ->columnSpan(1)
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\BelongsToSelect::make('user_id')
                                    ->relationship('user', 'name')
                                    ->required(),
                                Forms\Components\BelongsToSelect::make('topic_id')
                                    ->relationship('topic', 'name')
                                    ->required(),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                                            ->columnSpan(2)
                                            ->image(),
                                    ]),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\DateTimePicker::make('publish_at'),
                                Forms\Components\Toggle::make('ready'),
                                Forms\Components\Toggle::make('highlight'),
                            ]),
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Created at')
                                    ->content(fn (?Post $record): string => $record ? $record->created_at->diffForHumans() : '-'),
                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last modified at')
                                    ->content(fn (?Post $record): string => $record ? $record->updated_at->diffForHumans() : '-'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('publish_at')
                    ->dateTime(),
                Tables\Columns\BooleanColumn::make('highlight'),
                Tables\Columns\BooleanColumn::make('ready'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
