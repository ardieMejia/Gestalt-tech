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

            $initialTransArray = DB::table("transaction_data as t")
                   ->leftJoin('member_data','t.member_number','=','member_data.member_number')
                   ->selectRaw('member_data.job_title as job_title,count(*) as count,m2.memberCount')
                   ->join(DB::raw('(' . $memberCountQuery->toSql() . ') m2'),
                              function ($join) {
                                  $join->on('member_data.job_title','=','m2.job_title');
                              }
                   )
                   ->groupBy('member_data.job_title')
                   ->get();

            $initialTransArray = $initialTransArray->toArray();
            // ---------- trim trailing character I, II, III, IV
            $cleanedTransArray = [];
            foreach ($initialTransArray as $transItem) {
                $transItem->job_title = rtrim($transItem->job_title," I");
                $transItem->job_title = rtrim($transItem->job_title," II");
                $transItem->job_title = rtrim($transItem->job_title," III");
                $transItem->job_title = rtrim($transItem->job_title," IV");
                array_push($cleanedTransArray,["job_title" => $transItem->job_title,"count" => $transItem->count,"memberCount" => $transItem->memberCount]);
            }


            // loop through and add up similar job_titles
            $transArray = [];
            $first = $cleanedTransArray[0];
            $first["average"] = round($first["count"]/$first["memberCount"],3);

            array_push($transArray,$first);
            $job_title_prev = $cleanedTransArray[1]["job_title"];
            $count = $cleanedTransArray[1]["count"];
            $memberCount = $cleanedTransArray[1]["memberCount"];
            for ($i = 2; $i < sizeof($cleanedTransArray); $i++) {
                if ($cleanedTransArray[$i]["job_title"] == $job_title_prev) {
                    $count += $cleanedTransArray[$i]["count"];
                    $memberCount += $cleanedTransArray[$i]["memberCount"];
                } else {                 //   otherwise
                    array_push($transArray,["job_title" => $job_title_prev,"count" => $count,"memberCount" => $memberCount,"average" => round($count/$memberCount,2)]); // from the memberCount we calculate average
                    $job_title_prev = $cleanedTransArray[$i]["job_title"];
                    $count = $cleanedTransArray[$i]["count"];
                    $memberCount = $cleanedTransArray[$i]["memberCount"]; 
                }
            }

            return view("enquiry.transaction",['transArray' => $transArray]);




        }
    }
}
