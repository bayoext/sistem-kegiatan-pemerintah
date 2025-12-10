<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 months');

        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraphs(3, true),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $this->faker->randomElement(['Perencanaan', 'Berjalan', 'Selesai', 'Dibatalkan']),
            'budget' => $this->faker->randomFloat(2, 1000, 100000),
            'location' => $this->faker->city(),
            'thumbnail' => null,
        ];
    }
}
