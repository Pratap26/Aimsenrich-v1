<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('course_id');
            $table->string('course_name')->unique();
            $table->string('course_pattern');
            $table->string('course_structure');
            $table->string('course_duration');
            $table->longText('course_description');
            $table->string('course_route');
            $table->integer('status');
            $table->integer('creator_id')->references('userId')->on('users');
            $table->integer('creator_id');
            $table->integer('domain_id');
            $table->foreign('domain_id')->references('domain_id')->on('domains');
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
        Schema::dropIfExists('courses');
    }
}
