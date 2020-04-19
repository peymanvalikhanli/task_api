<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_member', function (Blueprint $table) {
           
            $table->integer('TaskID')->unsigned()->default('0');
            $table->integer('UserID')->unsigned()->default('0');
            $table->timestamps();
            $table->primary(['TaskID', 'UserID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
