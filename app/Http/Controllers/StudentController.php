<?php

namespace App\Http\Controllers;

use App\Models\UserExam;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is_student');
    }

    public function goToDashboard(): Renderable {
        $doneCourses = DB::table('courses')
            ->select('courses.id')
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->join('exams', 'exams.course_id', '=', 'courses.id')
            ->join('user_exams', 'user_exams.exam_id', '=', 'exams.id')
            ->where('user_courses.user_id', auth()->user()->id)
            ->where('user_exams.user_id', auth()->user()->id)
            ->where('user_exams.grade', '>', 17)
            ->groupBy('courses.id')
            ->get();

        $courses = DB::table('courses')
            ->select('courses.*')
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->where('user_courses.user_id', auth()->user()->id)
            ->whereNotIn('courses.id', $doneCourses->pluck('id')->toArray())
            ->orderBy('courses.year')
            ->orderBy('courses.semester')
            ->get();


        $exams = DB::table('exams')
            ->select('exams.*', 'courses.name as course_name')
            ->join('courses', 'exams.course_id', '=', 'courses.id')
            ->join('user_exams', 'exams.id', '=', 'user_exams.exam_id')
            ->where('user_exams.user_id', auth()->user()->id)
            ->where('exams.registered', '=', 0)
            ->orderBy('exams.date')
            ->get();

        return view('student.dashboard', [
            'courses' => $courses,
            'exams' => $exams
        ]);
    }

    public function goToCareer(): Renderable {
        $coursesGrades = DB::table('exams')
            ->select('exams.course_id', 'user_exams.grade', 'exams.date')
            ->join('user_exams', 'exams.id', '=', 'user_exams.exam_id')
            ->where('user_exams.user_id', auth()->user()->id)
            ->where('user_exams.grade', '>', '17');

        $courses = DB::table('courses')
            ->select('courses.*', 'courses_grades.grade')
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->leftJoinSub($coursesGrades, 'courses_grades', function ($join) {
                $join->on('courses.id', '=', 'courses_grades.course_id');
            })
            ->where('user_courses.user_id', auth()->user()->id)
            ->orderBy('courses.year')
            ->orderBy('courses.semester')
            ->get();

        $doneExams = DB::table('courses')
            ->select(DB::raw('courses.name, courses_grades.grade, courses.credits, ROUND(AVG(courses_grades.grade) OVER (ORDER BY courses_grades.date), 0) AS average'))
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->joinSub($coursesGrades, 'courses_grades', function ($join) {
                $join->on('courses.id', '=', 'courses_grades.course_id');
            })
            ->where('user_courses.user_id', auth()->user()->id)
            ->orderBy('courses_grades.date')
            ->get();

        $average = $doneExams->avg('grade') ?? 0;


        $totalCredits = $courses->sum('credits');
        $doneCredits = $doneExams->sum('credits');

        $weightedAverage = 0;
        if ($doneCredits > 0) {
            $weightedAverage = $doneExams->sum(function ($course) {
                return $course->grade * $course->credits;
            }) / $doneCredits;
        }


        // if there are more than 10 courses, we only show the last 10
        if ($doneExams->count() > 10) {
            $doneExams = $doneExams->slice($doneExams->count() - 10, 10);
        }

        return view('student.career', [
            'courses' => $courses,
            'doneExams' => $doneExams,
            'average' => $average,
            'totalCredits' => $totalCredits,
            'doneCredits' => $doneCredits,
            'weightedAverage' => $weightedAverage,
        ]);
    }

    public function goToExams(): Renderable {
        $exams = DB::table('exams')
            ->select('exams.*', 'c.name as course_name', 'ue.id as user_exam_id')
            ->join('courses as c', 'c.id', '=', 'exams.course_id')
            ->join('user_courses as uc', 'c.id', '=', 'uc.course_id')
            ->leftJoin('user_exams as ue', function ($join) {
                $join->on('exams.id', '=', 'ue.exam_id')
                    ->where(function ($query) {
                        $query->whereNull('ue.user_id')
                            ->orWhere('ue.user_id', '=', auth()->user()->id);
                    });
            })
            ->where('uc.user_id', '=', auth()->user()->id)
            ->whereNotIn('c.id', function ($query) {
                $query->select('courses.id')
                    ->from('courses')
                    ->join('exams', 'exams.course_id', '=', 'courses.id')
                    ->join('user_exams', 'user_exams.exam_id', '=', 'exams.id')
                    ->whereNotNull('user_exams.grade')
                    ->where('user_exams.user_id', '=', auth()->user()->id);
            })
            ->get();

        return view('student.exams', [
            'exams' => $exams
        ]);
    }

    public function bookExam(Request $request, $id): RedirectResponse
    {
        $userExam = new UserExam();
        $userExam->user_id = auth()->user()->id;
        $userExam->exam_id = $id;
        $userExam->save();

        return redirect()->route('student.exams');
    }

    public function deleteExamBooking(Request $request, $id): RedirectResponse
    {
        $userExam = UserExam::find($id);
        $userExam->delete();

        return redirect()->route('student.exams');
    }

    public function goToCourse($id): Renderable {
        $course = DB::table('courses')
            ->select('courses.*')
            ->where('courses.id', '=', $id)
            ->first();

        return view('student.course', [
            'course' => $course,
        ]);
    }
}
