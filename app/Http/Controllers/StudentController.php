<?php

namespace App\Http\Controllers;

use App\Models\UserExam;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is_student');
    }

    public function index(): Renderable {
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
            ->whereNull('user_exams.grade')
            ->orderBy('exams.date')
            ->get();

        return view('student/dashboard', [
            'courses' => $courses,
            'exams' => $exams
        ]);
    }

    public function career(): Renderable {
        $coursesGrades = DB::table('exams')
            ->select('exams.course_id', 'user_exams.grade')
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

        return view('student/career', [
            'courses' => $courses
        ]);
    }

    public function exams(): Renderable {
        $exams = DB::table('exams')
            ->select('exams.*', 'c.name as course_name', 'ue.id as user_exam_id')
            ->join('courses as c', 'c.id', '=', 'exams.course_id')
            ->join('user_courses as uc', 'c.id', '=', 'uc.course_id')
            ->leftJoin('user_exams as ue', function ($join) {
                $join->on('exams.id', '=', 'ue.exam_id')
                    ->where(function ($query) {
                        $query->whereNull('ue.user_id')
                            ->orWhere('ue.user_id', '=', 1);
                    });
            })
            ->where('uc.user_id', '=', 1)
            ->whereNotIn('exams.id', function ($query) {
                $query->select('exam_id')
                    ->from('user_exams')
                    ->where('grade', '>', 17)
                    ->where('user_id', '=', 1);
            })
            ->get();


        return view('student/exams', [
            'exams' => $exams
        ]);
    }

    public function bookExam(Request $request, $id) {
        $userExam = new UserExam();
        $userExam->user_id = auth()->user()->id;
        $userExam->exam_id = $id;
        $saved = $userExam->save();

        if ($saved) {
            return response()->json([
                'success' => true,
                'message' => 'Exam booked successfully',
                'user_exam_id' => $userExam->id
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error booking exam'
            ]);
        }
    }

    public function deleteExamBooking(Request $request, $id) {
        $userExam = UserExam::find($id);
        $deleted = $userExam->delete();
        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Exam booking deleted successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting exam booking'
            ]);
        }
    }
}
