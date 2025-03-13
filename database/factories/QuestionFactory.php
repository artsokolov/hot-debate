<?php

namespace Database\Factories;

use App\Models\ValueObject\QuestionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence() . '?',
            'status' => $this->faker->randomElement(QuestionStatus::values()),
            'is_anonymous' => $this->faker->boolean()
        ];
    }
}
