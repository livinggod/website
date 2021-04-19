<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class Publish extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Publish Now';

    public function handle(ActionFields $fields, Collection $models): void
    {
        foreach ($models as $model) {
            $model->publish_at = now();
            $model->save();
        }
    }
}
