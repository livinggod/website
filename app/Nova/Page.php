<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaTranslatable\HandlesTranslatable;

class Page extends Resource
{
    use HandlesTranslatable;

    public static string $model = \App\Models\Page::class;

    public static $title = 'url';

    public static $search = [
        'id', 'url'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Image::make('Image')
                ->disk('public')
                ->path('pages')
                ->deletable(false)
                ->creationRules('required'),

            Text::make('Title')
                ->sortable()
                ->translatable()
                ->placeholder('About us')
                ->rulesFor('en', [
                    'required',
                ]),

            Text::make('Url')
                ->sortable()
                ->placeholder('/about')
                ->required(),

            BooleanGroup::make('Locales')->options(config('localization.allowed_locales')),

            NovaEditorJs::make('Content')
                ->onlyOnDetail()
                ->required(),

            NovaEditorJs::make('Content')
                ->translatable()
                ->onlyOnForms()
                ->required(),
        ];
    }
}
