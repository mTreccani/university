<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use App\Models\UserCourse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            if ($user->year_in_progress === null) {
                $courses = Course::all()->random(5);
            } else {
                $totalCredits = 60 * $user->year_in_progress;
                $select = DB::table('courses')
                    ->where('year', '<=', $user->year_in_progress)
                    ->get();

                $courses = collect([]);
                while ($totalCredits > 0) {
                    $course = $select->random();
                    $totalCredits -= $course->credits;
                    if ($totalCredits >= 0) {
                        $courses->push($course);
                        $select = $select->where('id', '!=', $course->id);
                    } else {
                        $totalCredits += $course->credits;
                    }
                }
            }


            foreach ($courses as $course) {
                UserCourse::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ]);
            }
        }

    }
}
