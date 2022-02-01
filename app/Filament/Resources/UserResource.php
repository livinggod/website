<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use STS\FilamentImpersonate\Impersonate;

class UserResource extends Resource
{
    use Translatable;

    protected static ?string $model = User::class;
    protected static ?string $slug = 'settings/users';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\MarkdownEditor::make('bio')
                    ->nullable()
                    ->columnSpan(2),
                Forms\Components\Toggle::make('show_email')
                    ->columnSpan(2)
                    ->required(),
                Forms\Components\Toggle::make('super_admin')
                    ->columnSpan(2)
                    ->visible(auth()->user()->isSuperAdmin())
                    ->required(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                    ->image(),

                Forms\Components\BelongsToManyMultiSelect::make('user_roles')->relationship('roles', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('avatar'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                //
            ])
            ->prependActions([
                Impersonate::make('impersonate'),
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
            'index'  => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit'   => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
