<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\PreviousQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class PreviousQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return PreviousQuestion::with([
            'questionYear',
            'questionType'
        ])->whereHas('questionType', function($q) use($request) {
                if ($request->type){
                    $q->where('type', '=', $request->type);
                }
            })
            ->whereHas('questionYear', function($q) use($request) {
                if ($request->year){
                    $q->where('year', '=', $request->year);
                }
            })
            ->latest()
            ->paginate(15);
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
        if($file = $request->file('file')){
            //$name =  $file->getClientOriginalName();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $request['question_file_path'] = $fileName;
            if($file->move('Question',$fileName))
            {
                PreviousQuestion::create($request->all());
                return [
                    'status' => 200,
                    'message' => 'Question info created successfully',
                ];
            } else
            {
                return 'file not uploaded';
            }
        }else{
            return [
                'status' => 200,
                'message' => 'No file added',
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return PreviousQuestion::with(['questionYear', 'questionType'])->findOrFail($id);
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
    public function update(Request $request, PreviousQuestion $previousQuestion)
    {
        if($file = $request->file('file')){
            //$name =  $file->getClientOriginalName();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $request['question_file_path'] = $fileName;
            if($file->move('Question',$fileName))
            {
                $previousQuestion->update($request->all());
                return [
                    'status' => 200,
                    'message' => 'Question info updated successfully',
                ];
            } else
            {
                return 'file not uploaded';
            }
        }else{
            $previousQuestion->update($request->params['data']);
            return [
                'status' => 200,
                'message' => 'Question info updated successfully',
            ];
        }
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
        $question = PreviousQuestion::findOrFail($id);
        $question->delete();
        return [
            'status' => 200,
            'message' => 'Question deleted successfully',
        ];
    }

    public function download($id)
    {
        $question = PreviousQuestion::findOrFail($id);

        $file= public_path(). "/Question/".$question->question_file_path;

        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, $question->question_file_path, $headers);
    }

    public function previewQuestion($id)
    {
        $question = PreviousQuestion::findOrFail($id);
        $file= public_path(). "/Question/".$question->question_file_path;
        $headers = array(
            'Content-Type: application/pdf',
        );
        return response()->file($file, $headers);
    }

    public function search(Request $request)
    {
        if ($search = \Request::get('search')){
            $question = PreviousQuestion::with([
                'questionYear',
                'questionType'
            ])->where(function ($query) use ($search){
                    $query->where('question_title', 'LIKE', '%'.$search.'%');
                })->paginate(5);
            return $question;
        }
        return PreviousQuestion::with([
            'questionYear',
            'questionType'
        ])->latest()
            ->paginate(5);
    }
}
