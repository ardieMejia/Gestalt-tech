<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionData extends Model
{
    //
    public $fillable = ['amount', 'transaction_date', 'member_number'];
}
