<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'status'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}