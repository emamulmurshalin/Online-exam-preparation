<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam\Admin\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactInfo::with('status')->latest()
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
        $this->validate($request, [
            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|string|email|max:191',
        ]);
        $contact = ContactInfo::create($request->all());

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
    public function update(Request $request, ContactInfo $contactInfo)
    {
        $contactInfo->update($request->all());
        return [
            'status' => 200,
            'message' => 'Contact info updated successfully',
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
        $user = ContactInfo::findOrFail($id);
        $user->delete();
        return [
            'status' => 200,
            'message' => 'User deleted successfully',
        ];
    }

    public function search()
    {
        if ($search = \Request::get('search')){
            $contactInfo = ContactInfo::with('status')
                ->where(function ($query) use ($search){
                    $query->where('name', 'LIKE', '%'.$search.'%')
                        ->orWhere('phone', 'LIKE', '%'.$search.'%')
                        ->orWhere('email', 'LIKE', '%'.$search.'%');
                })->paginate(5);
            return $contactInfo;
        }
        return ContactInfo::with('status')
            ->latest()
            ->paginate(5);
    }
}
