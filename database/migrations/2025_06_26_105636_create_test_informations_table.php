<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('test_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->enum('test_type', ['stmu', 'mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other']);
            $table->string('test_center')->nullable();
            $table->string('test_name')->nullable();
            $table->decimal('test_score', 5, 2)->nullable();
            $table->string('test_document_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_informations');
    }
};