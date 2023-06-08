<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'attendance_id',
        'leave_request',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function attendance(){
        return $this->belongsTo(Attendance::class);
    }
}
