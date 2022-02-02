<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
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
};
