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
                            if (isset($block['type']) || $block['layout'] ?? '' !== 'wysiwyg') {
                                continue; // already converted
                            }

                            if (isset($block['attributes']['title'])) {
                                $newContent[] = [
                                    'data' => [
                                        'title' => $block['attributes']['title'],
                                    ],
                                    'type' => 'title',
                                ];
                            }

                            if (isset($block['attributes']['content'])) {
                                $newContent[] = [
                                    'data' => [
                                        'content' => $block['attributes']['content'],
                                    ],
                                    'type' => 'paragraph',
                                ];
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
                                    $newContent[] = [
                                        'data' => [
                                            'content' => '* '.$item,
                                        ],
                                        'type' => 'paragraph',
                                    ];
                                }

                                continue;
                            }

                            if (isset($block['data']['file'])) { // files
                                $newContent[] = [
                                    'data' => [
                                        'content' => "![image]({$block['data']['file']['url']})",
                                    ],
                                    'type' => 'paragraph',
                                ];

                                continue;
                            }

                            $newContent[] = [
                                'data' => [
                                    'content' => $block['data']['text'],
                                ],
                                'type' => 'paragraph',
                            ];
                        }
                    }
                    $model->setTranslation('content', $locale, $newContent);
                }

                $model->save();
            });
        }
    }
};
