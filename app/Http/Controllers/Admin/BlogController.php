<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\Post;
use App\Models\Exam\Admin\PostCatergory;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::with(['comments', 'status', 'postLike', 'category', 'user'])
            ->latest()
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
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
        ]);
        $request['user_id'] = Auth::user()->id;
        $post->create($request->all());
        return [
            'status' => 200,
            'message' => 'Post created successfully',
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
        return Post::with(['comments', 'status', 'postLike', 'category', 'user'])->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $post = Post::findOrFail($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'status_id' => 'required',
        ]);
        $request['user_id'] = Auth::user()->id;
        $post->update($request->all());
        return [
            'status' => 200,
            'message' => 'Post updated successfully',
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
        $post = Post::findOrFail($id);
        $post->delete();
        return [
            'status' => 200,
            'message' => 'Post deleted successfully',
        ];
    }

    public function getCategory()
    {
        return PostCatergory::latest()->get();
    }

    public function getStatus()
    {
        return Status::latest()->get();
    }

    public function search()
    {
        if ($search = \Request::get('search')){
            $post = Post::with(['comments', 'status', 'postLike', 'category', 'user'])
                ->where(function ($query) use ($search){
                    $query->where('title', 'LIKE', '%'.$search.'%');
                })->paginate(10);
            return $post;
        }
        return Post::with(['comments', 'status', 'postLike', 'category', 'user'])
            ->latest()
            ->paginate(10);
    }
}
