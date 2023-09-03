<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title=fake()->sentence();
        return [
            "title"=>$title,
            "slug"=>Str::slug($title),
            "description"=>fake()->realText(),
            "category_id"=>rand(1,5),
            "user_id"=>rand(1,11)
        ];
    }
}
