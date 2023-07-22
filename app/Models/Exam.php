<?php

namespace App\Models;

use App\Traits\AuditTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    use HasFactory, AuditTrait;

    protected function exams(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_exams');
    }
}
