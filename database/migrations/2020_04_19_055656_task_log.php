<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaskLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_log', function (Blueprint $table) {
            $table->integer('TaskID')->unsigned()->default('0');
            $table->integer('UserID')->unsigned()->default('0');
            $table->string('Action', 500)->nullable();
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
