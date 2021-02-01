<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    use HasFactory;
    public function previousQuestion()
    {
        return $this->hasMany(PreviousQuestion::class);
    }
    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
    protected $fillable = [
        'type',
    ];
}
