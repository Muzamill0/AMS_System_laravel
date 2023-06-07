<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    Public function index(Course $course){
        $data = [
            'course' => $course,
            'students' => Student::with('user')->where('course_id', $course->id)->get(),
            'courses' => Course::all(),
        ];
        return view('courseStudent.index', $data);
    }
}
