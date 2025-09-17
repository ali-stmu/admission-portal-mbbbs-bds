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
        Schema::table('academic_records', function (Blueprint $table) {
            $table->string('attachment')->nullable()->after('percentage');
        });
    }

    public function down()
    {
        Schema::table('academic_records', function (Blueprint $table) {
            $table->dropColumn('attachment');
        });
    }

};
