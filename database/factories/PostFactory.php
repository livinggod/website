<?php

namespace Database\Factories;

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
            'user_id' => User::factory()->create()->id,
            'image' => explode(base_path('public/storage/'), $this->faker->image(public_path('storage/posts'), 700, 400))[1],
            'slug' => Str::slug($title),
            'title' => ucwords($title),
            'content' => $this->faker->realText(),
            'published' => true,
        ];
    }
}
