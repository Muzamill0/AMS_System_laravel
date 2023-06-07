<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class DynamicController extends Controller
{
    public function fetch_attendance()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        // return json_encode($data);

        $attendances = Attendance::with('student')->where([
            ['course_id', $data['course_id']],
            ['date', $data['date']],
        ])->get();
        // return json_encode($attendances);

        if (count($attendances) > 0) {
            $output = '';
            foreach ($attendances as $attendance) {
                if ($attendance->status == 'present') {
                    $status = 'Present';
                } elseif ($attendance->status == 'absent') {
                    $status = 'Absent';
                } else {
                    $status = 'Leave';
                }

                $baseURL = "course/";
                $attendanceID = $attendance->id;
                $editURL = $baseURL . $attendanceID . "/attendance/edit";
                $link = '<a href="' . $editURL . '" class="btn btn-primary">Edit</a>';


                $deleteURL = $baseURL . $attendanceID . "/attendance/delete";
                $deleteLink = '<a href="' . $deleteURL . '" class="btn btn-primary">Delete</a>';

                $output .= '<tr><td>' . $attendance->student->reg_no . '</td><td>' .  $attendance->student->user->name  . '</td><td>' . $status . '</td><td> ' . $link .' '. $deleteLink . ' </td></tr>';
            }
        } else {
            $output = 'notFound';
        }
        return json_encode($output);
    }
}
