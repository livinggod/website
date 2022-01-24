<?php

use App\Models\Post;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        $localesToCheck = [
            'en',
            'nl'
        ];

        Post::query()->cursor()->each(function (Post $post) use ($localesToCheck) {
            $locales = [];

            foreach ($localesToCheck as $checkLocale) {
                if ($post->locales[$checkLocale] ?? false) {
                    $locales[] = $checkLocale;
                }
            }

            $post->locales = $locales;

            $post->save();
        });
    }
};
