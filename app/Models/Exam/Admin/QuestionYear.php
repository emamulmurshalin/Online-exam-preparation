<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionYear extends Model
{
    use HasFactory;
    public function previousQuestion()
    {
        return $this->hasMany(PreviousQuestion::class);
    }
    protected $fillable = [
        'year',
    ];
}
