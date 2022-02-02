<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TransferMedia extends Command
{
    protected $signature = 'media:transform';

    protected $description = 'Transform media to spatie media library';

    public function handle()
    {
        $queries = [
            [\App\Models\Page::query(), 'image'],
            [\App\Models\Post::query(), 'image'],
            [\App\Models\User::query(), 'avatar']
        ];

        foreach ($queries as [$query, $imageField]) {
            $query->cursor()->each(function (\Illuminate\Database\Eloquent\Model $model) use ($imageField) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($model->$imageField)) {
                    $model->addMedia(
                        \Illuminate\Support\Facades\Storage::disk('public')->path($model->$imageField)
                    )->toMediaCollection();
                }

                $model->save();
            });
        }
    }
}
