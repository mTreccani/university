<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'course_id'];

    public $incrementing = false;
}
