<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'email', 'phone_number', 'address', 'classroom_id',
        // ... other fields ...
    ];

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->withPivot('is_present');
    }

    // ... other methods ...
}
