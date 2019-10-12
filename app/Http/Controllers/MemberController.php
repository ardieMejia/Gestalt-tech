<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MemberData;
use Carbon\Carbon;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allMemberData = MemberData::all();
        return view('member.list_and_crud',['allMemberData' => $allMemberData]);
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
        //
        // $request->member_number;
        // MemberData->save();
        $newMember = new MemberData;
        $newMember->member_number = $request->member_number;
        $newMember->first_name = $request->first_name;
        $newMember->last_name = $request->last_name;
        $newDOB = Carbon::createFromFormat('m/d/Y',$request->dob);
        $newMember->dob = $newDOB;
        $newMember->email = $request->email;
        $newMember->gender = $request->gender;
        $newMember->job_title = $request->job_title;
        $newMember->save();


        return redirect()->route('member');


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
}
