<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableColumnsInStudentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Make existing columns nullable (if they already exist)
            $table->string('province')->nullable()->change();
            $table->string('father_nic')->nullable()->change();
            $table->string('mailing_sector')->nullable()->change();
            $table->string('mailing_tehsil')->nullable()->change();
            $table->string('mailing_house_no')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Revert back to NOT NULL (if needed)
            $table->string('province')->nullable(false)->change();
            $table->string('father_nic')->nullable(false)->change();
            $table->string('mailing_sector')->nullable(false)->change();
            $table->string('mailing_tehsil')->nullable(false)->change();
            $table->string('mailing_house_no')->nullable(false)->change();
        });
    }
}
