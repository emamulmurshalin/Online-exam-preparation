<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public function quizOption()
    {
        return $this->hasMany(QuizOption::class);
    }
    public function quizAnswer()
    {
        return $this->hasOne(QuizAnswer::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_types_id');
    }
    protected $fillable = [
        'quiz_question',
        'question_types_id',
        'subject_id'
    ];
}
