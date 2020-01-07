<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('UserName', 50);
            $table->string('Password', 150);
            $table->string('Avatar', 150)->nullable()->default('No Avatar');
            $table->string('token', 150)->nullable()->default('No token');
            $table->bigInteger('UserID')->nullable();
            $table->integer('OfficePosition')->unsigned();
            $table->text('ServerRef')->nullable()->default('No ServerRef');
            $table->timestamp('LastLogin')->nullable();
            $table->boolean('IsOnline')->nullable()->default(false);
            $table->timestamps();
            $table->unique(['UserName','Password']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
