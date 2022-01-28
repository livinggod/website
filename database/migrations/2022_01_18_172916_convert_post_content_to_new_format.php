<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        $queries = [
            Post::query(),
            Page::query(),
        ];

        foreach ($queries as $query) {
            $query->cursor()->each(function (Model $model) {
                foreach (array_unique(config('filament-spatie-laravel-translatable-plugin.default_locales')) as $locale) {
                    $newContent = [];
                    $content = $model->getTranslation('content', $locale);

                    if (is_array($content)) { // Newer format
                        if (empty($content) || isset(reset($content)['type'])) {
                            continue; // already converted
                        }

                        foreach ($content as $block) {
                            if (isset($block['type']) || (isset($block['layout']) && $block['layout'] ?? '' !== 'wysiwyg')) {
                                continue; // already converted
                            }

                            if (isset($block['attributes']['title'])) {
                                $newContent[] = '# '.$block['attributes']['title'];
                            }

                            if (isset($block['attributes']['content'])) {
                                $newContent[] = $block['attributes']['content'];
                            }
                        }
                    } else {

                        $raw = json_decode($content, true);

                        if (! isset($raw['blocks'])) {
                            continue; // No content
                        }

                        $blocks = $raw['blocks'];

                        foreach ($blocks as $block) {

                            if (isset($block['data']['style'])) { // Bullet lists
                                foreach ($block['data']['items'] as $item) {
                                    $newContent[] = '* '.$item;
                                }

                                continue;
                            }

                            if (isset($block['data']['file'])) { // files
                                $newContent[] = "![image]({$block['data']['file']['url']})";

                                continue;
                            }

                            $newContent[] = $block['data']['text'];
                        }
                    }

                    $newContent = array_map(fn (string $item) => \Illuminate\Support\Str::replace('\n', ' ', $item), $newContent);

                    $final = [
                        [
                            'data' => [
                                'content' => implode(PHP_EOL.PHP_EOL, $newContent),
                            ],
                            'type' => 'paragraph',
                        ],
                    ];
                    $model->setTranslation('content', $locale, $final);
                }

                $model->save();
            });
        }
    }
};
