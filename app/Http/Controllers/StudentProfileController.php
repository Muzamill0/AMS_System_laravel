<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentProfileController extends Controller
{
    public function index()
    {
        $data = [
            'student' => Student::where('user_id', auth()->user()->id)->first(),
        ];
        return view('student.profile.index', $data);
    }

    public function edit(Student $student)
    {
        $data = [
            'student' => $student,
        ];
        return view('student.profile.edit', $data);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'picture' => 'required', 'mimes:png,jpg,jpeg'
        ]);

        $user = User::where('id', $student->user_id)->first();

        $file = $request->picture;
        $file_name = 'aci-' . time() . '-' . $file->getClientOriginalName();

        $data = [
            'image' => $file_name
        ];

        $image_path = "'/student_uploads/'$user->image";
        // dd($image_path);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $user_update = User::find($user->id)->update($data);
        if($user_update){
            $file = $request['picture'];
            $file->move(public_path('student_uploads'), $file_name);
            return back()->with('success' , 'Image has been Updated');
        } else{
            return back()->with('error' , 'Image has failed to update');
        }

    }
}
