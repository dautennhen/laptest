<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePoolowner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poolowners', function (Blueprint $table) {
            $table->integer('user_id')->unique();
            $table->enum('pool_status', array('active', 'inactive'))->default('active');
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
        Schema::dropIfExists('poolowners');
    }
}
