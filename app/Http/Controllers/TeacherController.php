<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is_teacher');
    }

    public function goToDashboard(): Renderable
    {
        $courses = DB::table('courses')
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->where('user_courses.user_id', '=', auth()->user()->id)
            ->orderBy('courses.year')
            ->orderBy('courses.semester')
            ->get();

        $exams = DB::table('exams')
            ->select('exams.*', 'courses.name as course_name')
            ->join('courses', 'exams.course_id', '=', 'courses.id')
            ->where('exams.created_by', '=', auth()->user()->id)
            ->orderBy('exams.date')
            ->get();

        return view('teacher.dashboard', [
            'courses' => $courses,
            'exams' => $exams
        ]);
    }

    public function goToCreateExam(): Renderable
    {
        $courses = $this->userCourses();

        return view('teacher.exam', [
            'courses' => $courses,
        ]);
    }

    public function goToCourse($id): Renderable {
        $course = DB::table('courses')
            ->select('courses.*')
            ->where('courses.id', '=', $id)
            ->first();

        return view('teacher.course', [
            'course' => $course,
        ]);
    }

    private function userCourses(): Collection
    {
        return DB::table('courses')
            ->join('user_courses', 'courses.id', '=', 'user_courses.course_id')
            ->where('user_courses.user_id', '=', auth()->user()->id)
            ->orderBy('courses.year')
            ->orderBy('courses.semester')
            ->get();
    }

    public function createExam(Request $request): RedirectResponse
    {
        $validator = $this->validateExamRequest($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exam = new Exam();
        return $this->setExamValueAndRedirect($request, $exam);
    }

    public function editExam(Request $request, $id): RedirectResponse
    {
        $validator = $this->validateExamRequest($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $exam = Exam::find($id);
        return $this->setExamValueAndRedirect($request, $exam);
    }

    public function goToEditExam(Request $request, $id): Renderable
    {
        $exam = DB::table('exams')
            ->select('exams.*', 'courses.name as course_name')
            ->join('courses', 'exams.course_id', '=', 'courses.id')
            ->where('exams.id', '=', $id)
            ->first();

        $courses = $this->userCourses();

        return view('teacher.exam', [
            'exam' => $exam,
            'courses' => $courses,
        ]);
    }

    public function goToExamGrades($id): Renderable {
        $users = DB::table('users')
            ->select('users.*', 'user_exams.grade')
            ->join('user_exams', 'users.id', '=', 'user_exams.user_id')
            ->orderBy('user_exams.created_at')
            ->get();

        $exam = DB::table('exams')
            ->select('exams.*', 'courses.name as course_name')
            ->join('courses', 'exams.course_id', '=', 'courses.id')
            ->where('exams.id', '=', $id)
            ->first();

        return view('teacher.grades', [
            'users' => $users,
            'exam' => $exam,
        ]);
    }

    public function insertGrades(Request $request, $id): RedirectResponse
    {
//        validate request and insert grades
        $exam = Exam::find($id);
        $exam->registered = true;
        $exam->save();
        return redirect()->route('teacher.dashboard');
    }

    private function validateExamRequest(Request $request): \Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), [
            'course' => 'required',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'date' => 'required|date|after:end_date',
            'duration' => 'nullable|date_format:H:i',
            'room'=> 'nullable|string|max:255'
        ]);
    }

    /**
     * @param Request $request
     * @param $exam
     * @return RedirectResponse
     */
    private function setExamValueAndRedirect(Request $request, $exam): RedirectResponse
    {
        $exam->course_id = $request->input('course');
        $exam->description = $request->input('description');
        $exam->booking_start_date = $request->input('start_date');
        $exam->booking_end_date = $request->input('end_date');
        $exam->date = $request->input('date');
        $exam->room = $request->input('room');
        $exam->duration = $request->input('duration');
        $exam->save();
        return redirect()->route('teacher.dashboard');
    }
}
