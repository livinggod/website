<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Block extends Resource
{
    public static string $model = \App\Models\Block::class;

    public static $title = 'code';

    public static $search = [
        'id', 'code'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Code')
                ->sortable()
                ->rules('required', 'string', function ($attribute, $value, $fail) {
                    if (strtolower($value) !== $value) {
                        return $fail('The '.$attribute.' field must be lowercase.');
                    }
                }),

            Trix::make('Content')
                ->rules('required'),
        ];
    }
}
