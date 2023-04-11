<?php

namespace App\Http\Controllers;

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
//        $this->middleware('auth');
    }


    public function index(): Renderable
    {
        return view('student/dashboard');
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
