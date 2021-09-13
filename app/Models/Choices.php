<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choices extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'quiz_id',
        'choice',
        'is_correct_choice',
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function studentAnswerQuiz()
    {
        return $this->hasMany(StudentQuizAnswer::class);
    }
}
