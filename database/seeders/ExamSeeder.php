<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\UserCourse;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseIds = DB::table('user_courses')
            ->select("user_courses.course_id")
            ->distinct()
            ->get()
            ->pluck('course_id')
            ->toArray();
        foreach ($courseIds as $courseId) {
            $userIds = DB::table('user_courses')
                ->join("users", "user_courses.user_id", "=", "users.id")
                ->where("user_courses.course_id", "=", $courseId, "and")
                ->where("users.role", "=", "teacher")
                ->get();

            if (count($userIds) === 0) {
                continue;
            }
            $userId = $userIds->random()->id;

            $startDate = fake()->dateTimeBetween('-6 month', '+2 month');

            $minEndDate = clone $startDate;
            $maxEndDate = (clone $startDate)->modify('+2 week');
            $endTimestamp = rand($minEndDate->getTimestamp(), $maxEndDate->getTimestamp());
            $endDate = new DateTime();
            $endDate->setTimestamp($endTimestamp);

            $minDate = clone $endDate;
            $maxDate = (clone $endDate)->modify('+1 week');
            $dateTimestamp = rand($minDate->getTimestamp(), $maxDate->getTimestamp());
            $date = new DateTime();
            $date->setTimestamp($dateTimestamp);

            Exam::create([
                'course_id' => $courseId,
                'description' => fake()->text(50),
                'booking_start_date' => $startDate,
                'booking_end_date' => $endDate,
                'date' => $date,
                'duration' => fake()->optional()->time('H:i'),
                'room' => fake()->text(5),
                'created_by' => $userId,
                'updated_by' => $userId,
                'registered' => isBeforeOrEqualNow($date) && fake()->boolean(50),
            ]);
        }
    }
}
