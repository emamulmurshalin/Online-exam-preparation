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
    protected $fillable = [
        'quiz_question',
    ];
}
