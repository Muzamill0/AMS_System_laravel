<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Course;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index()
    {
        $data = [
            'leaves' => Leave::with('student', 'attendance')->where('leave_request' , 0)->get(),
            'courses' => Course::all()
        ];
        return view('leaves.index', $data);
    }

    public function store(Request $request, Leave $leave)
    {
        $students = $request->except('_token', 'date');
        $count = 0;
        foreach ($students as $key => $value) {
            if ($value == 'Accept') {
                $data = [
                    'student_id' => $key,
                    'attendance_id' => $leave->attendance->id,
                    'leave_request' => 1,
                ];
                Leave::find($leave->id)->update($data);

                $data = [
                    'student_id' => $key,
                    'course_id' => $leave->student->course->id,
                    'date' => $leave->attendance->date,
                    'status' => 'Leave',
                ];
                $attendance_update = Attendance::find($leave->attendance->id)->update($data);
                // dd($data);
                if($attendance_update){
                    return back()->with('success', 'Leave Accepted');
                } else{
                    return back()->with('error', 'Leave has failed to accept');
                }
            } else {
                $data = [
                    'student_id' => $key,
                    'attendance_id' => $leave->attendance->id,
                    'leave_request' => 2,
                ];

                Leave::find($leave->id)->update($data);

                $data = [
                    'student_id' => $key,
                    'course_id' => $leave->student->course->id,
                    'date' => $leave->attendance->date,
                    'status' => 'Leave Rejected',
                ];
                $attendance_update = Attendance::find($leave->attendance->id)->update($data);
                if($attendance_update){
                    return back()->with('success', 'Leave rejected');
                } else{
                    return back()->with('error', 'leave has failed to reject');
                }
            }

            $count++;
        }

        // $student_id = array_keys($students);



    }
}
