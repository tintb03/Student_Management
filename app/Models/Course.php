<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'description', 'teacher_id', 'major_id', 'start_date', 'end_date',
        // ... other fields ...
    ];


    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id')
            ->withPivot('is_present')
            ->withTimestamps();
    }
        public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

        public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }


}
