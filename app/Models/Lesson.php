<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Lesson extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'discussion',
        'summary',
        'youtube_url',
        'publish_date',
        'due_date',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at','publish_date','due_date'];


    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }

    public function writingTask()
    {
        return $this->hasMany(WritingTask::class);
    }

    public function logs()
    {
        return $this->hasMany(StudentLog::class);
    }
}
