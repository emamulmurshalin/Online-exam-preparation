<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Front\QuizMark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class QuizMarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = Auth::user();
        if ($authUser->role == 'User'){
            return QuizMark::with(['user'])
                ->where('user_id', $authUser->id)
                ->paginate(10);
        }
        return QuizMark::with(['user'])
            ->paginate(10);
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
    public function store(Request $request, QuizMark $quizMark)
    {
        $request['user_id'] = Auth::user()->id;
        $quizMark->create($request->all());
        return [
            'status' => 200,
            'message' => 'Model test info save successfully',
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quizMark = QuizMark::findOrFail($id);
        $quizMark->delete();
        return [
            'status' => 200,
            'message' => 'Quiz info deleted successfully',
        ];
    }

    public function search()
    {
        if ($search = \Request::get('search')){
            $quizMark = QuizMark::with('user')
                ->where(function ($query) use ($search){
                    $query->where('marks', 'LIKE', '%'.$search.'%')
                        ->orWhere('total_marks', 'LIKE', '%'.$search.'%');
                })->paginate(10);
            return $quizMark;
        }
        return QuizMark::with('user')
            ->latest()
            ->paginate(10);
    }
}
