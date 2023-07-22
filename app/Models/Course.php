<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected function user()
    {
        return $this->belongsToMany(User::class, 'user_courses');
    }
}
