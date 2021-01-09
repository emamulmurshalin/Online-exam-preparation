<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function getsubject()
    {
        return Subject::latest()->get();
    }
}
