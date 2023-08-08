<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('major_id');
            $table->timestamps();

            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->foreign('major_id')->references('id')->on('majors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
