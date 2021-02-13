<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;


class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'user', 'title'
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
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('Author', 'user', User::class)
                ->readonly(!auth()->user()->isSuperAdmin())
                ->default(auth()->user()->id),

            Image::make('Image')
                ->disk('public')
                ->path('posts')
                ->creationRules('required'),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex()
                ->hideFromDetail(),

            Slug::make('Slug')->from('Title')
                ->readonly(!auth()->user()->isSuperAdmin())
                ->rules('required')
                ->hideFromIndex()
                ->hideFromDetail(),

            Stack::make('Details', [
                Text::make('Title')
                    ->sortable()
                    ->rules('required', 'max:255'),

                Text::make('Slug')->resolveUsing(function () {
                    return view('components.nova.url', [
                        'post' => $this->resource,
                    ])->render();
                })->asHtml(),
            ]),

            Text::make('Description')
                ->sortable()
                ->rules('max:255')
                ->hideFromIndex(),

            DateTime::make('Publish At')
                ->format('DD MMM YYYY H:mm:ss')
                ->sortable()
                ->nullable(),

            Boolean::make('Published')
                ->resolveUsing(fn () => $this->resource->publish_at === null || $this->resource->publish_at <= now())
                ->onlyOnIndex(),

            NovaEditorJs::make('Content')->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new Actions\Publish)
                ->showOnTableRow(),
        ];
    }
}
