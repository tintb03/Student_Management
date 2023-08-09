<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('classroom_student', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('classroom_id');
        $table->unsignedBigInteger('student_id');
        $table->boolean('is_present')->default(false);
        $table->timestamps();
        
        $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_student');
    }
};
