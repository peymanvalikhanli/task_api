<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatGroupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_group__users', function (Blueprint $table) {
            $table->bigInteger('ChatGroupID');
            $table->bigInteger('UserID');
            $table->integer('Permission')->unsigned()->nullable();
            $table->integer('RemoveFromGroup')->unsigned()->nullable();
            $table->integer('RemoveBy')->unsigned()->nullable();
            $table->timestamp('RemoveDate')->nullable();
            $table->integer('LeaveGroup')->unsigned()->nullable();
            $table->timestamp('LeaveDate')->nullable();
            $table->timestamps();
            $table->primary(['ChatGroupID', 'UserID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_group__users');
    }
}
