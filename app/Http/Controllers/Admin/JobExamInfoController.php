<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\JobExamInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JobExamInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return JobExamInfo::latest()
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
    public function store(Request $request, JobExamInfo $jobExamInfo)
    {
        $this->validate($request, [
            'job_title' => 'required',
            'exam_date' => 'required',
            'exam_time' => 'required',
        ]);
        $jobExamInfo->create($request->all());
        return [
            'status' => 200,
            'message' => 'Job info created successfully',
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
        return JobExamInfo::findOrFail($id);
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
        $jobInfo = JobExamInfo::findOrFail($id);

        $this->validate($request, [
            'job_title' => 'required',
            'exam_date' => 'required',
            'exam_time' => 'required',
        ]);
        $jobInfo->update($request->all());
        return [
            'status' => 200,
            'message' => 'Job exam info updated successfully',
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobInfo = JobExamInfo::findOrFail($id);
        $jobInfo->delete();
        return [
            'status' => 200,
            'message' => 'Job info deleted successfully',
        ];
    }

    public function search()
    {
        if ($search = \Request::get('search')){
            $examInfo = JobExamInfo::where(function ($query) use ($search){
                    $query->where('job_title', 'LIKE', '%'.$search.'%');
                })->paginate(10);
            return $examInfo;
        }
        return JobExamInfo::latest()->paginate(10);
    }
}
