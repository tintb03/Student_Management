<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'day_of_week', 'start_time', 'end_time', 'room_number']; // Thêm 'room_number' vào fillable

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
