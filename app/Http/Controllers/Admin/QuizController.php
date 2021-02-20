<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\Quiz;
use App\Models\Exam\Admin\QuizAnswer;
use App\Models\Exam\Admin\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Quiz::with([
            'quizOption', 'quizAnswer', 'questionType', 'subject'])
            ->latest()
            ->paginate(15);
    }

    public function getQuiz(Request $request)
    {
        return Quiz::with([
                    'quizOption',
                    'quizAnswer',
                    'questionType',
                    'subject'
                ])
                ->whereHas('questionType', function($q) use($request) {
                    if ($request->type){
                        $q->where('type', '=', $request->type);
                    }
                })
                ->whereHas('subject', function($q) use($request) {
                    if ($request->subject){
                        $q->where('name', '=', $request->subject);
                    }
                })
                ->inRandomOrder()
                ->limit(3)
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
            'message' => 'Quiz option created successfully',
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
        return Quiz::with([
            'quizOption', 'quizAnswer', 'questionType', 'subject'])
            ->findOrFail($id);
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
        dd($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('isAdmin');
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return [
            'status' => 200,
            'message' => 'Quiz deleted successfully',
        ];
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
        return Quiz::with(['quizOption', 'quizAnswer'])
            ->latest()
            ->get();
    }

    public function search()
    {
        if ($search = \Request::get('search')){
            $quiz = Quiz::with([
                'quizOption', 'quizAnswer', 'questionType', 'subject'])
                ->where(function ($query) use ($search){
                $query->where('quiz_question', 'LIKE', '%'.$search.'%');
            })->paginate(5);
            return $quiz;
        }
        return Quiz::with([
            'quizOption', 'quizAnswer', 'questionType', 'subject'])
            ->latest()
            ->paginate(5);
    }

    public function getOptionByQuiz($id)
    {
        return Quiz::with(['quizOption'])->findOrFail($id);
    }
}
