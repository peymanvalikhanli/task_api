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
            $table->integer('Permission')->unsigned()->nullable()->default('1');
            $table->integer('RemoveFromGroup')->unsigned()->nullable()->default('0');
            $table->integer('RemoveBy')->unsigned()->nullable()->default('0');
            $table->timestamp('RemoveDate')->nullable();
            $table->integer('LeaveGroup')->unsigned()->nullable()->default('0');
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
