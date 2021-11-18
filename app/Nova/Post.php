<?php

namespace App\Nova;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Nova\Metrics\ArticlesPerTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Database\Eloquent\Builder;
use OptimistDigital\NovaTranslatable\HandlesTranslatable;
use Whitecube\NovaFlexibleContent\Flexible;

class Post extends Resource
{
    use HandlesTranslatable;

    public static string $model = \App\Models\Post::class;

    public static $title = 'title';

    public static $group = 'Content';

    public static $search = [
        'id', 'title', 'slug'
    ];

    public static $preventFormAbandonment = true;

    public function fields(Request $request): array
    {
        return [
            BelongsTo::make('Author', 'user', User::class)
                ->readonly(!auth()->user()->can('change-author'))
                ->hideFromIndex()
                ->default(auth()->user()->id),

            BelongsTo::make('Topic')
                ->showCreateRelationButton()
                ->rules('required'),

            Image::make('Image')
                ->disk('public')
                ->path('posts')
                ->creationRules('required')
                ->deletable(false),

            Text::make('Title')
                ->rules('max:255')
                ->hideFromIndex(),

            $this->url()->onlyOnDetail(),

            Text::make('Description')
                ->rules('max:255')
                ->hideFromIndex(),

            Stack::make('Details', [
                Text::make('Title')
                    ->rules('max:255'),


                $this->url(),
            ])->onlyOnIndex(),

            DateTime::make('Publish At')
                ->format('DD MMM YYYY H:mm:ss')
                ->sortable()
                ->readonly(!auth()->user()->can('publish-post'))
                ->nullable(),

            Boolean::make('Published')
                ->resolveUsing(fn () => !is_null($this->resource['publish_at']) && $this->resource['publish_at'] <= now())
                ->onlyOnIndex(),

            Boolean::make('Highlight')
                ->sortable()
                ->onlyOnIndex(),

            Boolean::make('Ready')
                ->readonly(!auth()->user()->can('publish-post'))
                ->sortable(),

            BooleanGroup::make('Locales')->options(config('localization.allowed_locales')),

            Flexible::make('Content')
                ->button('Add new section')
                ->confirmRemove()
                ->addLayout('Simple content section', 'wysiwyg', [
                    Text::make('Title'),
                    Markdown::make('Content')
                ])
                ->addLayout('Video section', 'video', [
                    Text::make('Title'),
                    Image::make('Video Thumbnail', 'thumbnail'),
                    Text::make('Video ID (YouTube)', 'video'),
                    Text::make('Video Caption', 'caption')
                ]),
        ];
    }

    public function cards(Request $request): array
    {
        return [
            new ArticlesPerTopic(),
        ];
    }

    public function filters(Request $request): array
    {
        return [
            new Filters\Highlighted(),
        ];
    }

    public function actions(Request $request): array
    {
        return [
            (new Actions\Publish)
                ->showOnTableRow()
                ->canSeeWhen('publish-post'),
            (new Actions\Highlight)
                ->showOnTableRow()
                ->canSeeWhen('highlight-post'),
            (new Actions\CalculateRead)
                ->showOnTableRow()
                ->canSeeWhen('calculate-read-time'),
            (new Actions\MarkAsReady)
                ->showOnTableRow()
                ->canSeeWhen('mark-post-as-ready'),
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

    protected function url(): Text
    {
        return Text::make(__('Url'), 'slug')->resolveUsing(function () {
            return view('components.nova.url', [
                'post' => $this->resource,
            ])->render();
        })->asHtml();
    }
}
