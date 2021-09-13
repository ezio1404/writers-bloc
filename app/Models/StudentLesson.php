<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLesson extends Model
{
    use HasFactory;

    protected $table = 'student_lessons';

    protected $fillable = [
        'student_log_id',
        'quiz_id',
        'choice_id',
        'answer',
        'points',
    ];
}
