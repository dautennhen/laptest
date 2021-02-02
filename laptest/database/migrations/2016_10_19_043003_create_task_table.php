<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
			$table->string('assignee');
			$table->dateTime('duedate');
			$table->integer('est_hour');
			$table->text('desc');
			$table->tinyInteger('order');
        });
    }
	
	
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('task');
    }
}
