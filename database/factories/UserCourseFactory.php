<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserCourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string
     */
    protected $model = UserCourse::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userCount = User::all()->count();
        $courseCount = Course::all()->count();

        $userCourses = [];
        for ($i = 1; $i <= $userCount; $i++) {
            for ($j = 1; $j <= $courseCount; $j++) {
                $userCourses[] = $i . "-" . $j;
            }
        }

        $userAndCourse = fake()->unique()->randomElement($userCourses);
        $userAndCourse = explode('-', $userAndCourse);
        $userId = $userAndCourse[0];
        $courseId = $userAndCourse[1];

        return [
            'user_id' => $userId,
            'course_id' => $courseId,
        ];
    }
}
