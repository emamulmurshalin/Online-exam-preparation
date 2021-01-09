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
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    protected $fillable = [
        'quiz_question',
        'subject_id'
    ];
}
