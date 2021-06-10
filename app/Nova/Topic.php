<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Topic extends Resource
{
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
                ->rules('required', 'max:50'),

            Text::make('Slug')
                ->readonly()
                ->onlyOnDetail(),

            Textarea::make('Description')
                ->translatable()
                ->rules('max:255'),
        ];
    }
}
