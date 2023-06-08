<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Course;
use App\Models\Student;
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

                $output .= '<tr><td>' . $attendance->student->reg_no . '</td><td>' .  $attendance->student->user->name  . '</td><td>' . $status . '</td><td> ' . $link . ' ' . $deleteLink . ' </td></tr>';
            }
        } else {
            $output = 'notFound';
        }
        return json_encode($output);
    }

    public function single_student_view(Student $student)
    {
        $data = [
            'student' => $student,
            'courses' => Course::all(),
        ];
        return view('courseStudent.attendences.single_student', $data);
    }


    public function fetch_single_student_attendance()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $student_id = $data['studentId'];

        if (Carbon::parse($from_date)->gt(Carbon::parse($to_date))) {
            echo json_encode(['error' => 'From date should be greater then or equal to the otherone! ']);
        } else {
            $attendances = Attendance::with('student')
                ->where('student_id', $student_id)
                ->whereBetween('date', [$from_date, $to_date])->get();

            $total_presents = 0;
            $total_absenties = 0;
            $total_leaves = 0;

            if(!$attendances){
                    return json_encode(['error' => 'No attendance Found!']);
            }
            $output = '';
            foreach ($attendances as $attendance) {
                // return json_encode($attendance);
                $status = "";
                if (strtolower($attendance->status) == 'present') {
                    $total_presents++;
                    $status = '<span class="badge bg-success">Present</span>';
                } elseif (strtolower($attendance->status) == 'leave') {
                    $total_leaves++;
                    $status = '<span class="badge bg-warning">Leave</span>';
                } else {
                    $total_absenties++;
                    $status = '<span class="badge bg-danger">Absent</span>';
                }
                $output .= '
                <tr>
                <td>' . $attendance->date . '</td>
                <td>' . $attendance->student->user->name . '</td>
                <td>' . $status . '</td>
                </tr>
                ';
                // return json_encode($output);
            }
            $grade = '';
            if ($total_presents > 10 && $total_presents < 16) {
                $grade = '<td class="bg-warning text-white">D</td>';
            }elseif ($total_presents > 16 && $total_presents < 21) {
                $grade = '<td class="bg-primary text-white">C</td>';
            }elseif ($total_presents > 20 && $total_presents < 26) {
                $grade = '<td class="bg-info text-white">B</td>';
            }elseif ($total_presents > 25) {
                $grade = '<td class="bg-success text-white">A</td>';
            }elseif ($total_presents < 10) {
                $grade = '<td class="bg-danger text-white">F</td>';
            }


            $output .= '<tr> <th>Total Presents</th>
            <th>Total Absenties</th>
            <th>Total Leaves</th>
            <th>Grades</th>  </tr>
            <tr> <td>' . $total_presents . '</td>
            <td>' . $total_absenties . '</td>
            <td>' . $total_leaves . '</td>
            '.$grade .' </tr>';

            echo json_encode($output);

        }
    }
}
