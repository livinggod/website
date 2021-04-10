<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Nova\Metrics\ArticlesPerTopic;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Database\Eloquent\Builder;

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
        'id', 'title', 'slug'
    ];

    /**
     * Indicates whether Nova should prevent the user from leaving an unsaved form, losing their data.
     *
     * @var bool
     */
    public static $preventFormAbandonment = true;


    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Author', 'user', User::class)
                ->readonly(!auth()->user()->can('change-author'))
                ->hideFromIndex()
                ->default(auth()->user()->id),

            BelongsTo::make('Category')
                ->sortable()
                ->showCreateRelationButton()
                ->rules('required'),

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
                ->readonly(!auth()->user()->can('publish-post'))
                ->nullable(),

            Boolean::make('Published')
                ->resolveUsing(fn () => !is_null($this->resource->publish_at) && $this->resource->publish_at <= now())
                ->onlyOnIndex(),

            Boolean::make('Highlight')
                ->sortable()
                ->onlyOnIndex(),

            Boolean::make('Ready')
                ->readonly(!auth()->user()->can('publish-post'))
                ->sortable(),

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
        return [
            new ArticlesPerTopic(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\Highlighted(),
        ];
    }

    public function actions(Request $request)
    {
        if (!$request->user()->can('publish-post')) {
            return [];
        }

        return [
            (new Actions\Publish)
                ->showOnTableRow(),
            (new Actions\Highlight)
                ->showOnTableRow(),
            (new Actions\CalculateRead)
                ->showOnTableRow(),
            (new Actions\MarkAsReady)
                ->showOnTableRow(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        return $request->user()->can('view-posts')
            ? $query
            : $query->where([
                ['user_id', $request->user()->id],
                ['publish_at', '<=', now()],
            ]);
    }
}
