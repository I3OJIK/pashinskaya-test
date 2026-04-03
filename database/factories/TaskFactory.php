<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;


class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(8, true),
            'status' => $this->faker->randomElement([
                TaskStatus::NEW,
                TaskStatus::IN_PROGRESS,
                TaskStatus::DONE
            ]),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
