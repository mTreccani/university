<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exam;
use Illuminate\Contracts\Support\Renderable;

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
        //FIXME: Fix queries
        $courses = Course::join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->where('user_courses.user_id', auth()->user()->id)
            ->get();

        $exams = Exam::join('user_exams', 'exams.id', '=', 'user_exams.exam_id')
            ->join('courses', 'exams.course_id', '=', 'courses.id')
            ->select('exams.*', 'courses.name as course_name')
            ->where('user_exams.user_id', auth()->user()->id)
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
