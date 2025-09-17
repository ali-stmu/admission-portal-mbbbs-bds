<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestYearAndResultStatusToTestInformationTable extends Migration
{
    public function up()
    {
        Schema::table('test_informations', function (Blueprint $table) {
            $table->year('test_year')->nullable()->after('test_score');
            $table->enum('result_status', ['awaited', 'declared'])->default('declared')->after('test_year');
        });
    }

    public function down()
    {
        Schema::table('test_informations', function (Blueprint $table) {
            $table->dropColumn(['test_year', 'result_status']);
        });
    }
}
