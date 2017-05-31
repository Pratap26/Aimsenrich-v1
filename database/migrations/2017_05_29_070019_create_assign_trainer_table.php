<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignTrainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::create('assign_trainer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id');
            $table->integer('unit_id');
            $table->integer('subunit_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('trainer_id');
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
        Schema::dropIfExists('assign_trainer');
    }
}
