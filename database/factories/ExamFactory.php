<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->first()->id,
            'description' => fake()->text(50),
            'date' => fake()->dateTimeBetween('+2 month', '+3 month'),
            'duration' => fake()->time(),
            'booking_start_date' => fake()->dateTimeBetween('-1 month', '+1 month'),
            'booking_end_date' => fake()->dateTimeBetween('+1 month', '+2 month'),
            'room' => fake()->text(5),
        ];
    }
}
