<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingdayTodolistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workingday_todolists', function (Blueprint $table) {
            $table->integer('workingday_id')->unsigned()->nullable();
			$table->foreign('workingday_id')->references('id')
			->on('workingday')->onDelete('cascade');
			$table->integer('todolist_id')->unsigned()->nullable();
			$table->foreign('todolist_id')->references('id')
			->on('todolists')->onDelete('cascade');
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
        Schema::drop('workingday_todolists');
    }
}
