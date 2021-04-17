<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            'category_id' => Category::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'image' => $this->fakeEditorJS(),
            'slug' => Str::slug($title),
            'title' => ucwords($title),
            'content' => $this->faker->realText(),
            'publish_at' => now()->subDay(),
            'minutes' => $this->faker->randomDigit(),
            'highlight' => false,
            'ready' => true,
        ];
    }

    protected function fakeEditorJS()
    {
        return '{"time":1615732528852,"blocks":[{"type":"paragraph","data":{"text":"testing"}}],"version":"2.19.0"}';
    }
}
