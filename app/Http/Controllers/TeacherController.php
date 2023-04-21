<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        return view('teacher/dashboard');
    }

    public function exam(): Renderable
    {
        return view('teacher/exam');
    }
}
