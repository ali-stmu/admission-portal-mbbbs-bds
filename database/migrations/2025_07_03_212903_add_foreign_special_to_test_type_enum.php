<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignSpecialToTestTypeEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // For MySQL
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE test_informations MODIFY COLUMN test_type ENUM('stmu', 'mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other', 'foreign-special')");
        }
        
        // For PostgreSQL
        elseif (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement("ALTER TABLE test_informations ALTER COLUMN test_type TYPE VARCHAR(255)");
            DB::statement("ALTER TABLE test_informations ADD CONSTRAINT test_informations_test_type_check CHECK (test_type IN ('stmu', 'mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other', 'foreign-special'))");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // For MySQL
        if (DB::connection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE test_informations MODIFY COLUMN test_type ENUM('stmu', 'mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other')");
        }
        
        // For PostgreSQL
        elseif (DB::connection()->getDriverName() === 'pgsql') {
            DB::statement("ALTER TABLE test_informations DROP CONSTRAINT test_informations_test_type_check");
            DB::statement("ALTER TABLE test_informations ADD CONSTRAINT test_informations_test_type_check CHECK (test_type IN ('stmu', 'mdcat', 'sat-ii', 'foreign-mcat', 'ucat', 'other'))");
        }
    }
}