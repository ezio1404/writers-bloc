<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentWritingTask extends Model
{
    use HasFactory;
    protected $table = 'student_writing_tasks';
        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'student_log_id',
        'writing_task_id',
        'task_answer',
        'points',
    ];

    public function studentLog()
    {
        return $this->belongsTo(StudentLog::class);
    }

    public function writingTask()
    {
        return $this->belongsTo(WritingTask::class);
    }
}
