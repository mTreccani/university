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
        $year = now()->year;
        return [
            'name' => fake()->jobTitle(),
            'formative_objectives' => fake()->paragraph(20),
            'prerequisites' => fake()->paragraph(10),
            'course_schedule' => fake()->paragraph(30),
            'year' => fake()->randomElement([$year-1, $year, $year+1]),
            'semester' => fake()->randomElement([1, 2]),
            'credits' => fake()->randomElement([6, 9, 12]),
        ];
    }
}
