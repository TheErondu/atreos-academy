<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->foreignId('course_id')->references('id')->on('courses');
            $table->foreignId('lesson_id')->references('id')->on('lessons');
            $table->string('options')->nullable();
            $table->string('correct_option')->nullable();
            $table->string('answer')->nullable();
            $table->string('correct_answer')->nullable();
            $table->integer('score');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
