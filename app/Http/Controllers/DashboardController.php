<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home(){
        $data = [
            'courses' => Course::with('students')->get(),
        ];
        return view('dashboard', $data);
    }
}
