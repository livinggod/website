<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->title,
            'url' => Str::slug($title),
            'content' => ['en' => []],
            'locales' => ['en', 'nl'],
        ];
    }
}
