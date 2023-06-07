<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $data = [
            'course' => $course,
            'courses' => Course::all(),

        ];
        return view('courseStudent.attendences.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $data= [
            'courses' => Course::all(),
            'students' => Student::with('user')->where('course_id', $course->id)->get(),
            'course' => $course,
        ];
        return view('courseStudent.attendences.create' , $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Course $course)
    {
        $request->validate([
            'date' => [
                'required',
                Rule::unique('attendances')->where(fn ($query) => $query->where([
                    ['course_id', $course->id],
                    ['date', $request->date],
                ]))
            ],
        ], [
            'date.unique' => 'Attendance for this date is already taken'
        ]);
        $students = $request->except('_token', 'date');
        $count = 0;
            foreach ($students as $key => $value) {
                $data = [
                    'student_id' => $key,
                    'course_id' => $course->id,
                    'date' => $request->date,
                    'status' => $value,
                ];

                $is_attendance_created = Attendance::create($data);
                if($is_attendance_created){
                    $count++;
                }
            }

            if ($count == count($students)) {
                return back()->with('success', 'Attendance has been successfully added!');
            } else {
                return back()->with('error', 'Attendance details has failed to add!');
            }


    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $data = [
            'courses' => Course::all(),
            'attendance' => $attendance,
        ];

        return view('courseStudent.attendences.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
