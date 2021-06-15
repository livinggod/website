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
            'image' => 'pages/'.Str::uuid().'.jpg',
            'url' => '/'.Str::slug($title),
            'content' => $this->fakeEditorJS(),
            'locales' => ['en' => true, 'nl' => true],
        ];
    }

    protected function fakeEditorJS(): string
    {
        return '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"Lorem ipsum dolor sit amet."}}],"version":"2.19.0"}';
    }
}
