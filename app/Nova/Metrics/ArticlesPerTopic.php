<?php

namespace App\Nova\Metrics;

use App\Models\Post;
use App\Models\Topic;
use DateInterval;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class ArticlesPerTopic extends Partition
{
    public function calculate(NovaRequest $request): PartitionResult
    {
        return $this->count($request, Post::class, 'topic_id')
            ->label(fn ($value) => Topic::find($value)->name);
    }

    public function cacheFor(): DateTimeInterface|DateInterval|float|int
    {
         return now()->addMinutes(10);
    }

    public function uriKey(): string
    {
        return 'articles-per-topic';
    }
}
