<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Chisme;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChismeComment>
 */
class ChismeCommentFactory extends Factory
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
            'chisme_id' => Chisme::factory(),
            'author_id' => User::factory()
        ];
    }
}
