<?php

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        $localesToCheck = [
            'en',
            'nl'
        ];

        $queries = [
            Post::query(),
            \App\Models\Page::query(),
            \App\Models\Topic::query(),
        ];

        foreach ($queries as $query) {
            $query->cursor()->each(function (Model $model) use ($localesToCheck) {
                $locales = [];

                foreach ($localesToCheck as $checkLocale) {
                    if ($model->locales[$checkLocale] ?? false) {
                        $locales[] = $checkLocale;
                    }
                }

                $model->locales = $locales;

                $model->save();
            });
        }
    }
};
