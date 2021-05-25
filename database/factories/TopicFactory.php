<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition(): array
    {
        return [
            'name' => $name = $name ?? $this->faker->unique()->name,
            'slug' => $slug ?? Str::slug($name),
            'description' => $this->faker->realText(200),
        ];
    }
}
