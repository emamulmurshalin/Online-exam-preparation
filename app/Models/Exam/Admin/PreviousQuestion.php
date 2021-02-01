<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousQuestion extends Model
{
    use HasFactory;
    public function questionYear()
    {
        return $this->belongsTo(QuestionYear::class, 'question_years_id');
    }
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'question_types_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
    protected $fillable = [
        'question_title',
        'question_file_path',
        'question_years_id',
        'question_types_id',
        'subject_id'
    ];
}
