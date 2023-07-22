<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
            'formative_objectives' => fake()->paragraph(20),
            'prerequisites' => fake()->paragraph(10),
            'course_schedule' => fake()->paragraph(30),
            'year' => fake()->numberBetween(1, 5),
            'semester' => fake()->randomElement([1, 2]),
            'credits' => fake()->randomElement([3, 6, 9, 12]),
        ];
    }
}
