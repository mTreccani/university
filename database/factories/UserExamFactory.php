<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string
     */
    protected $model = UserExam::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::where('id', '>', 0)->inRandomOrder()->first()->id;
        $examId = Exam::join('user_courses', 'exams.course_id', '=', 'user_courses.course_id')
            ->where('user_id', '=', $userId)->inRandomOrder()->first()->id;
        return [
            'user_id' => $userId,
            'exam_id' => $examId,
            'grade' => fake()->optional()->numberBetween(18, 30),
        ];
    }
}
