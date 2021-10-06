<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'lesson_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class)->withTrashed();
    }

    public function studentQuizAnswer()
    {
        return $this->hasMany(StudentQuizAnswer::class);
    }

    public function studentWritingTaskAnswer()
    {
        return $this->hasMany(StudentWritingTask::class);
    }
}
