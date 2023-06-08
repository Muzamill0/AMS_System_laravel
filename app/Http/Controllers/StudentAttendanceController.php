<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentAttendanceController extends Controller
{
    public function index(){

        $student = Student::with('user','course')->where('user_id', auth()->user()->id )->first();
        $data = [
            'attendances' => Attendance::with('student')->where('student_id', $student->id)->get()
        ];
        // dd($data);

        return view('student.attendances.index', $data);
    }

    public function create(Student $student){

        $data = [
            'student' => $student,
        ];
        // dd($student);
        return view('student.attendances.create', $data);
    }

    public function store(Request $request , Student $student){
        $request->validate([
            'date' => [
                'required',
                Rule::unique('attendances')->where(fn ($query) => $query->where([
                    ['student_id', $student->id],
                    ['date', $request->date],
                ]))
            ],
        ], [
            'date.unique' => 'Attendance for this date is already taken'
        ]);
        $students = $request->except('_token', 'date');
        $count = 0;
            foreach ($students as $key => $value) {
                if($value == 'Leave'){
                    $status = 'Leave Pending';
                } else{
                    $status = $value;
                }
                $data = [
                    'student_id' => $key,
                    'course_id' => $student->course->id,
                    'date' => $request->date,
                    'status' => $status,
                ];

                $is_attendance_created = Attendance::create($data);
                if($is_attendance_created){
                    $count++;
                }
            }

            if ($count == count($students)) {
                $data = [
                    'student_id' => $student->id,
                    'attendance_id' => $is_attendance_created->id,
                    'leave_request' => 0,
                ];
                Leave::create($data);
                return back()->with('success', 'Attendance has been successfully added!');
            } else {
                return back()->with('error', 'Attendance details has failed to add!');
            }
    }
}
