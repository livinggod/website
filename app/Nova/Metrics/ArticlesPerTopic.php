<?php

namespace App\Nova\Metrics;

use App\Models\Category;
use App\Models\Post;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class ArticlesPerTopic extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Post::class, 'category_id')
            ->label(fn ($value) => Category::find($value)->name);
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
         return now()->addMinutes(10);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'articles-per-topic';
    }
}
