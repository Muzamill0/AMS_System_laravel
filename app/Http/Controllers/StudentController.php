<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'course')->get();
        $data = [
            'students' => $students,
            'courses' => Course::all(),
        ];
        return view('students.index', $data);
    }

    public function create()
    {
        $data = [
            'users_type' => [
                'Admin',
                'Student'
            ],
            'courses' => Course::all()
        ];
        return view('students.create', $data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
        ]);

        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = Hash::make(12345);
        }

        if ($request->user_type == 'Admin') {
            $user_type = 'Admin';
        } else {
            $user_type = 'Student';

            if (!empty($request->phone)) {
                $request->validate([
                    'phone' => ['unique:users,contact_no']
                ]);
            }

            if (!empty($request->picture)) {
                $request->validate([
                    'picture' => ['mimes:png,jpg,jpeg']
                ]);

                $file = $request['picture'];
                $file_name = 'image-' . time() . '-' . $file->getClientOriginalName();
            } else {
                $file_name = 'avatar.png';
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'contact_no' => $request->phone,
                'password' => $password,
                'image' => $file_name,
                'dob' => $request->dob,
                'address' => $request->address,
                'user_type' => $user_type,
            ];
            // dd($data);

            $is_user_created = User::create($data);

            if ($is_user_created) {
                $file = $request['picture'];

                if ($file) {
                    $is_file_uploaded = $file->move(public_path('student_uploads'), $file_name);
                }

                $reg_no = ' reg-' . $request->name . $is_user_created->id;

                $data = [
                    'user_id' => $is_user_created->id,
                    'course_id' => $request->course,
                    'reg_no' => $reg_no
                ];

                $is_student_created = Student::create($data);

                if ($is_student_created) {
                    return back()->with('success', 'student has registered successfully');
                } else {
                    return back()->with('error', 'student has failed to register!');
                }
            } else {
                return back()->with('error', 'user has failed to create');
            }
        }
    }
    public function show(Student $student)
    {
        $data = [
            'student' => $student,
            'courses' => Course::all(),
        ];
        return view('students.show_profile', $data);
    }

    public function edit(Student $student)
    {
        $data = [
            'users_type' => [
                'Admin',
                'Student'
            ],
            'student' => $student,
            'courses' => Course::all()
        ];
        return view('students.edit', $data);
    }

    public function update(Request $request, Student $student)
    {
        // dd($request->all());

        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $student->user->id . ',id'],
        ]);

        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = Hash::make(12345);
        }

        if ($request->user_type == 'Admin') {
            $user_type = 'Admin';
        } else {
            $user_type = 'Student';
        }

        if (!empty($request->phone)) {
            $request->validate([
                'phone' => ['unique:users,contact_no,' . $student->user->id . ',id']
            ]);
        }

        if (!empty($request->picture)) {
            $request->validate([
                'picture' => ['mimes:png,jpg,jpeg']
            ]);

            $file = $request['picture'];
            $file_name = 'image-' . time() . '-' . $file->getClientOriginalName();
        } else {
            $file_name = 'avatar.png';
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->phone,
            'password' => $password,
            'image' => $file_name,
            'dob' => $request->dob,
            'address' => $request->address,
            'user_type' => $user_type,
        ];
        // dd($data);

        $is_user_updated = User::find($student->user->id)->update($data);

        if ($is_user_updated) {
            $file = $request['picture'];

            if ($file) {
                $file->move(public_path('student_uploads'), $file_name);
            }

            $reg_no = ' reg' . $request->name . $student->user->id;

            $data = [
                'user_id' => $student->user->id,
                'course_id' => $request->course,
                'reg_no' => $reg_no
            ];

            $is_student_updated = Student::find($student->id)->update($data);

            if ($is_student_updated) {
                return back()->with('success', 'student has successfully updated');
            } else {
                return back()->with('error', 'student has failed to update!');
            }
        } else {
            return back()->with('error', 'user has failed to create');
        }
    }
}
