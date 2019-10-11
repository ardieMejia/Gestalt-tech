<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_data', function (Blueprint $table) {

            // $table->date('created_at');
            $table->increments('id');
            $table->string('member_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('job_title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_data');
    }
}
