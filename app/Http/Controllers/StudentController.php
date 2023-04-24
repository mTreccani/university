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
        $courses = Course::all();

        return view('student/dashboard', [
            'courses' => $courses,
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
