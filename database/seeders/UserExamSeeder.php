<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\User;
use App\Models\UserExam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exams = DB::table('exams')
            ->select('exams.*')
            ->where('exams.booking_start_date', '<', now())
            ->get();
        foreach ($exams as $exam) {
            $users = DB::table('user_courses')
                ->select('user_courses.*')
                ->where('user_courses.course_id', $exam->course_id)
                ->get()
                ->pluck('user_id')
                ->toArray();

            foreach ($users as $user) {
                $isDone = DB::table('user_exams')
                    ->select('user_exams.*')
                    ->where('user_exams.user_id', $user)
                    ->where('user_exams.exam_id', $exam->id)
                    ->where('user_exams.grade', '>', 17)
                    ->exists();

                if ($isDone) {
                    continue;
                }

                UserExam::create([
                    'user_id' => $user,
                    "exam_id" => $exam->id,
                    "grade" => $exam->registered ? fake()->numberBetween(1, 30) : null,
                ]);
            }
        }
    }
}
