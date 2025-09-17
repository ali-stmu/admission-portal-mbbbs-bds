<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->enum('level', ['matric', 'intermediate']);
            $table->string('school_college');
            $table->string('board');
            $table->integer('year');
            $table->enum('result_status', ['declared', 'awaited']);
            $table->integer('maximum_marks');
            $table->integer('obtained_marks');
            $table->decimal('percentage', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('academic_records');
    }
};