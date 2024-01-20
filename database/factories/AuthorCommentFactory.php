<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthorComment>
 */
class AuthorCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->realText($maxNbChars = 100, $indexSize = 2),
            'author_id' => User::factory(),
            'recipient_id' => User::factory()
        ];
    }
}
