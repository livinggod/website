<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use KABBOUCHI\NovaImpersonate\Impersonate;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Vyuldashev\NovaPermission\RoleBooleanGroup;

class User extends Resource
{
    public static string $model = \App\Models\User::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'email',
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Avatar')
                ->maxWidth(50)
                ->disk('public')
                ->path('users'),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Slug')
                ->readonly()
                ->onlyOnDetail(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Textarea::make('Bio')
                ->translatable(),

            RoleBooleanGroup::make('Roles')
                ->hideFromIndex(!auth()->user()->can('manage-user-roles'))
                ->hideFromDetail(!auth()->user()->can('manage-user-roles'))
                ->hideWhenUpdating(!auth()->user()->can('manage-user-roles')),

            new Panel('Settings', $this->settings()),

            Impersonate::make($this->resource)
                ->withMeta([
                    'redirect_to' => '/nova'
                ]),
        ];
    }

    public function settings(): array
    {
        return [
            Boolean::make('Show Email', 'show_email'),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        return $request->user()->can('view-users')
            ? $query
            : $query->where('id', $request->user()->id);
    }
}
