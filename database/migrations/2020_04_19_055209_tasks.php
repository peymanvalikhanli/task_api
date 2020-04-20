<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50)->nullable();
            $table->text('Dsc')->nullable()->default('');
            $table->integer('Stat')->unsigned()->default('0'); // todo | doing | done | cancel | ....
            $table->text('CheckLists')->nullable()->default(''); // json data intigration
            $table->timestamp('DueDate')->nullable();
            $table->integer('CreatedBy')->unsigned()->default('0');
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
        //
    }
}
