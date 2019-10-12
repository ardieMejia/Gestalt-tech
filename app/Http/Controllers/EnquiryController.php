<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function search()
    {
        //


        if (Input::get('type',null) == "transaction"){

            $memberCountQuery = DB::table("member_data")
                   ->selectRaw('member_data.job_title as job_title,count(*) as memberCount')
                              ->groupBy('member_data.job_title');

            $cache = DB::table("transaction_data as t")
                   ->leftJoin('member_data','t.member_number','=','member_data.member_number')
                   ->selectRaw('member_data.job_title as job_title,count(*) as count,m2.memberCount')
                   ->join(DB::raw('(' . $memberCountQuery->toSql() . ') m2'),
                              function ($join) {
                                  $join->on('member_data.job_title','=','m2.job_title');
                                      
                              }
                   )
                   ->groupBy('member_data.job_title')
                   ->get();








            dd($cache);
        }
    }
}
