<?php

namespace App\Nova\Actions;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Highlight extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models): array
    {
        if ($models->count() > 1) {
            return Action::danger('Please only select 1 article to highlight.');
        }

        $model = $models->first();

        if (!$model->isPublished()) {
            return Action::danger('Only published articles can be highlighted!');
        }

        if ($model->highlight) {
            return Action::message('This article was already highlighted.');
        }

        Post::where('highlight', 1)
            ->update(['highlight' => 0]);

        $model->update(['highlight' => 1]);

        $model->save();

        return Action::message('Article successfully highlighted!');
    }
}
