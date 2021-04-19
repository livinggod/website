<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'category_id' => Category::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'image' => 'posts/'.Str::uuid().'.jpg',
            'slug' => Str::slug($title),
            'title' => ucwords($title),
            'content' => $this->fakeEditorJS(),
            'publish_at' => now()->subDay(),
            'minutes' => $this->faker->randomDigit(),
            'highlight' => false,
            'ready' => true,
        ];
    }

    protected function fakeEditorJS(): string
    {
        return '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"Lorem ipsum dolor sit amet."}}],"version":"2.19.0"}';
    }
}
