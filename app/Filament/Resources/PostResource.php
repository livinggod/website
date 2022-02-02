<?php

namespace App\Filament\Resources;

use App\Filament\Cards\TimestampCard;
use App\Filament\CustomFields\LocaleCheckbox;
use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;
    protected static ?string $slug = 'blog/posts';
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
                                            ->prefix(config('app.url').'/')
                                            ->maxLength(255)
                                            ->unique(Post::class, 'slug', fn ($record) => $record),
                                        Forms\Components\TextInput::make('description')
                                            ->columnSpan('full'),
                                    ]),
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
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\BelongsToSelect::make('user_id')
                                    ->relationship('user', 'name')
                                    ->disabled(fn () => ! request()->user()->can('change-author'))
                                    ->required(),
                                Forms\Components\BelongsToSelect::make('topic_id')
                                    ->relationship('topic', 'name')
                                    ->required(),
                            ]),
                        Forms\Components\Card::make()
                            ->hidden(fn () => ! auth()->user()->can('publish-post'))
                            ->schema([
                                Forms\Components\DateTimePicker::make('publish_at'),
                                Forms\Components\Toggle::make('ready'),
                                Forms\Components\Toggle::make('highlight'),
                                LocaleCheckbox::make(),
                            ]),
                        TimestampCard::make(),
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
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with('user')
            ->when(
                ! auth()->user()->isSuperAdmin()
                || ! auth()->user()->can('view-posts'),
                fn (Builder $builder) =>
                    $builder->whereBelongsTo(auth()->user())
            );
    }
}
