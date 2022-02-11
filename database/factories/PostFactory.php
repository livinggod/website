<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'topic_id' => Topic::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'image' => 'posts/'.Str::uuid().'.jpg',
            'slug' => Str::slug($title),
            'title' => ucwords($title),
            'description' => $this->faker->realText(200),
            'content' => ['en' => []],
            'publish_at' => now()->subDay(),
            'locales' => ['nl', 'en'],
            'highlight' => false,
            'ready' => true,
        ];
    }
}
