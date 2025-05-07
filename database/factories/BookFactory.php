<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'isbn' => $this->faker->isbn13(),
            'cover_url' => $this->faker->imageUrl(200, 300, 'books', true),
            'author_id' => Author::factory(), // ова автоматски ќе креира нов автор
        ];
    }
}
