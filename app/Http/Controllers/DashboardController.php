<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        $data = [
            'leaves' => Leave::with('student', 'attendance')->where('leave_request' , 0)->get(),
            'courses' => Course::with('students')->get(),
        ];
        return view('dashboard', $data);
    }

    public function student_home(){
        $student = Student::with('user','course')->where('user_id', auth()->user()->id )->first();
        $leave = Leave::with('student', 'attendance')->where([
            'leave_request' => 1,
            'student_id' => $student->id,
        ] )->orWhere([
            'leave_request' => 2,
            'student_id' => $student->id,
        ])->first();
        if($leave->leave_request ==  1){
            return view('student.dashboard' , ['success' , 'Leave request has been Accepted']);

        } elseif($leave->leave_request ==  2){
            return view('student.dashboard' , ['error' , 'Leave request has been Rejected']);

        }

        // dd($data);
    }
}
