<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MemberData extends Model
{
    //
    public $fillable = ['member_number', 'first_name', 'last_name', 'dob', 'email', 'gender', 'job_title'];



}
