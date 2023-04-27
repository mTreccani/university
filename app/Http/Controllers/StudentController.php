<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_student');
    }


    public function index(): Renderable
    {
        $courses = Course::join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->leftJoin('exams', 'courses.id', '=', 'exams.course_id')
            ->leftJoin('user_exams', 'exams.id', '=', 'user_exams.exam_id')
            ->where('user_courses.user_id', auth()->user()->id)
            ->where('user_exams.grade', '=', null)
            ->orWhere('user_exams.grade', '<', 18)
            ->select('courses.*')
            ->orderBy('courses.year')
            ->get();

        $exams = Exam::join('courses', 'exams.course_id', '=', 'courses.id')
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->leftJoin('user_exams', 'exams.id', '=', 'user_exams.exam_id')
            ->select('exams.*', 'courses.name as course_name', DB::raw('CASE WHEN user_exams.id IS NOT NULL THEN 1 ELSE 0 END as booked'))
            ->where('user_courses.user_id', auth()->user()->id)
            ->orderBy('exams.date')
            ->get();

        return view('student/dashboard', [
            'courses' => $courses,
            'exams' => $exams
        ]);
    }

    public function booking(): Renderable
    {
        return view('student/bookings');
    }

    public function career(): Renderable
    {
        return view('student/career');
    }
}
