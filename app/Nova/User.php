<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
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
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
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

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Textarea::make('Bio'),

            RoleBooleanGroup::make('Roles')
                ->hideFromIndex(!auth()->user()->can('manage-user-roles'))
                ->hideFromDetail(!auth()->user()->can('manage-user-roles'))
                ->hideWhenUpdating(!auth()->user()->can('manage-user-roles')),

            new Panel('Settings', $this->settings()),
        ];
    }

    public function settings()
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
