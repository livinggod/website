<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Page extends Resource
{
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
            Text::make('Title')->sortable()->placeholder('About us')->required(),
            Text::make('Url')->sortable()->placeholder('/about')->required(),
            NovaEditorJs::make('Content')->hideFromIndex()->required(),
        ];
    }
}
