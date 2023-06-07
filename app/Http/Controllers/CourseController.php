<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', ['courses' => $courses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'courses' => Course::all(),
        ];
        return view('courses.create' , $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:courses,name'],
        ]);

        $data = [
            'name' => $request->name,
        ];

        $is_course_created = Course::create($data);

        if ($is_course_created) {
            return back()->with('success', 'Course has been successfully created');
        } else {
            return back()->with('error', 'Course has failed to create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $data = [
            'courses' => Course::all(),
            'course' => $course
        ];
        return view('courses.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => ['required', 'unique:courses,name,' . $course->id . ',id'],
        ]);

        $data = [
            'name' => $request->name,
        ];

        $is_course_upated = Course::find($course->id)->update($data);

        if ($is_course_upated) {
            return back()->with('success', 'Course has been successfully updated');
        } else {
            return back()->with('error', 'Course has failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
