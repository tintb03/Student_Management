<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'email', 'phone_number', 'address',
        // ... other fields ...
    ];
    

    // ... other methods ...
}
