<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseFrameworkSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('course_framework_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('unit_id');
            $table->string('subunit_id');
            $table->string('subject_code');
            $table->string('subject_title');
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
       Schema::dropIfExists('course_framework_subjects');
    }
}
