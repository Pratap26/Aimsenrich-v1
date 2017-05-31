<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('class_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('batch_name');
            $table->string('availablity_i')->nullable();
            $table->string('availablity_ii')->nullable();
            $table->string('location');
            $table->integer('fees_inr');
            $table->integer('fees_usd');
            $table->integer('domain_id');
            $table->foreign('domain_id')->references('domain_id')->on('domains');
            $table->integer('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
