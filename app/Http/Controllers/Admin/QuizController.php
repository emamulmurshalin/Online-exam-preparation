<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\Quiz;
use App\Models\Exam\Admin\QuizAnswer;
use App\Models\Exam\Admin\QuizOption;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Quiz::with('quizOption', 'quizAnswer', 'questionType')
            ->latest()
            ->paginate(15);
    }

    public function getQuiz()
    {
        return Quiz::with('quizOption', 'quizAnswer', 'questionType')
            ->inRandomOrder()
            ->limit(2)
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        QuizOption::create($request->all());

        return [
            'status' => 200,
            'message' => 'User created successfully',
        ];
    }

    public function addQuizAnswer(Request $request)
    {
        QuizAnswer::create($request->all());

        return [
            'status' => 200,
            'message' => 'User created successfully',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addQuizQuestion(Request $request)
    {
        $this->validate($request, [
            'quiz_question' => 'required',
        ]);
        $quiz = Quiz::create($request->all());
        return [
            'status' => 200,
            'message' => 'Quiz question created successfully',
        ];
    }
    public function getQuizQuestion()
    {
        return Quiz::latest()->get();
    }
}
