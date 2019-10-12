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
            $cache = DB::table("transaction_data")
                   ->leftJoin('member_data','transaction_data.member_number','=','member_data.member_number')
                   ->selectRaw('member_data.job_title,count(*) as count')
                   ->groupBy('member_data.job_title')
                   ->get();


            $cache = $cache->toArray();
            // ---------- trim trailing character I, II, III, IV
            $newCache = [];
            foreach ($cache as $cacheItem) {
                $cacheItem->job_title = rtrim($cacheItem->job_title," I");
                $cacheItem->job_title = rtrim($cacheItem->job_title," II");
                $cacheItem->job_title = rtrim($cacheItem->job_title," III");
                $cacheItem->job_title = rtrim($cacheItem->job_title," IV");
                array_push($newCache,["job_title" => $cacheItem->job_title,"count" => $cacheItem->count]);
            }

            $newArray = [];
            array_push($newArray,$newCache[0]);
            $job_title_prev = $newCache[1]["job_title"];
            $count = $newCache[1]["count"];
            for ($i = 2; $i < sizeof($newCache); $i++) {
                if ($newCache[$i]["job_title"] == $job_title_prev) {
                    $count += $newCache[$i]["count"];
                } else {                 //   otherwise
                    array_push($newArray,["job_title" => $job_title_prev,"count" => $count]);
                    $job_title_prev = $newCache[$i]["job_title"];
                    $count = $newCache[$i]["count"];
                }
            }
            return view("enquiry.transaction",['newArray' => $newArray]);
        }
    }
}
