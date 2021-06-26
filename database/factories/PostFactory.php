<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Topic;
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
            'topic_id' => Topic::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'image' => 'posts/'.Str::uuid().'.jpg',
            'slug' => Str::slug($title),
            'title' => ucwords($title),
            'description' => $this->faker->realText(200),
            'content' => $this->fakeEditorJS($this->faker->text(1000)),
            'publish_at' => now()->subDay(),
            'minutes' => $this->faker->randomDigit(),
            'highlight' => false,
            'ready' => true,
        ];
    }

    protected function fakeEditorJS(string $text): string
    {
        return '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"'.$text.'"}}],"version":"2.19.0"}';
    }
}
