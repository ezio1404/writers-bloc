<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuizAnswer extends Model
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

    public function studentLog()
    {
        return $this->belongsTo(StudentLog::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class)->withTrashed();
    }

    public function choice()
    {
        return $this->belongsTo(Choices::class)->withTrashed();
    }
}
