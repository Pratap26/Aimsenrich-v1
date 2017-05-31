<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseFrameworkSubunitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_framework_subunits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->foreign('course_id')->references('course_id')->on('courses');
            $table->integer('unit_id');
            $table->foreign('unit_id')->references('id')->on('course_framework_units');
            $table->integer('subunit_id')->nulable();
            $table->string('subheading');
            $table->longText('content');
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
        Schema::dropIfExists('course_framework_subunits');
    }
}
