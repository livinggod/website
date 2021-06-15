<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaTranslatable\HandlesTranslatable;

class Topic extends Resource
{
    use HandlesTranslatable;

    public static string $model = \App\Models\Topic::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Name')
                ->sortable()
                ->translatable()
                ->rules('max:50')
                ->rulesFor('en', [
                    'required',
                ]),

            Text::make('Slug')
                ->readonly()
                ->onlyOnDetail(),

            Textarea::make('Description')
                ->translatable()
                ->rules('max:255'),

            BooleanGroup::make('Locales')->options(config('localization.allowed_locales')),
        ];
    }
}
