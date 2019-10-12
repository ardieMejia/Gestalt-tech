<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    //
    public static function insertMemberData($data){

        // $value=DB::table('users')->where('username', $data['username'])->get();
        // if($value->count() == 0){
            // DB::table('users')->insert($data);
            // DB::table('member_data')->insert($data);
        DB::table('member_data')->insert($data);

        // }
    }
    public static function insertTransactionData($data){

        // $value=DB::table('users')->where('username', $data['username'])->get();
        // if($value->count() == 0){
        // DB::table('users')->insert($data);
        // DB::table('member_data')->insert($data);
        DB::table('transaction_data')->insert($data);

        // }
    }

}
