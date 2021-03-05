<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\Post;
use App\Models\Exam\Admin\PreviousQuestion;
use App\Models\Exam\Admin\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function quizQuestion()
    {
        $totalQuiz = Quiz::all()->count();
        $totalQuestion = PreviousQuestion::all()->count();
        $totalUser = User::all()->count();
        $totalPost = Post::all()->count();
        return [
            'totalQuiz' => $totalQuiz,
            'totalQuestion' => $totalQuestion,
            'totalUser' => $totalUser,
            'totalPost' => $totalPost
        ];
    }
}
