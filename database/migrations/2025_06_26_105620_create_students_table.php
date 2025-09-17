<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('application_no')->unique();
            $table->string('photo_path');
            $table->string('name');
            $table->string('cnic')->unique();
            $table->string('cnic_copy_path');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('mobile');
            $table->string('passport_no')->nullable();
            $table->string('passport_copy_path')->nullable();
            $table->string('domicile');
            $table->string('email')->unique();
            $table->enum('nationality', ['pakistani', 'foreign']);
            $table->string('province');
            
            // Father's information
            $table->string('father_name');
            $table->string('father_nic');
            $table->string('father_email')->nullable();
            $table->string('father_profession')->nullable();
            $table->string('father_company')->nullable();
            $table->string('father_mobile');
            $table->string('father_res_phone')->nullable();
            $table->string('father_office_phone')->nullable();
            
            // Addresses
            $table->text('mailing_address');
            $table->string('mailing_house_no');
            $table->string('mailing_street');
            $table->string('mailing_sector');
            $table->string('mailing_tehsil');
            $table->string('mailing_city');
            $table->string('mailing_country');
            
            $table->text('permanent_address')->nullable();
            $table->string('permanent_house_no')->nullable();
            $table->string('permanent_street')->nullable();
            $table->string('permanent_sector')->nullable();
            $table->string('permanent_tehsil')->nullable();
            $table->string('permanent_city')->nullable();
            $table->string('permanent_country')->nullable();
            
            $table->foreignId('term_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};