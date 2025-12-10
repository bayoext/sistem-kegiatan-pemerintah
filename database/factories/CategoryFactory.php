<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $colors = ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'];

        return [
            'name' => $this->faker->unique()->words(2, true),
            'description' => $this->faker->sentence(),
            'color' => $this->faker->randomElement($colors),
        ];
    }
}
