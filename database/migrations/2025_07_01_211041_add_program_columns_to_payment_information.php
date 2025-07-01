<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// In the migration file
public function up()
{
    Schema::table('payment_informations', function (Blueprint $table) {
        $table->string('local_program')->nullable()->after('program');
        $table->string('intl_program')->nullable()->after('local_program');
        $table->string('special_program')->nullable()->after('intl_program');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_informations', function (Blueprint $table) {
            //
        });
    }
};
