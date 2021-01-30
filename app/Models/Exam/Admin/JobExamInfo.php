<?php

namespace App\Models\Exam\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobExamInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'exam_date',
        'exam_time'
    ];
}
