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
    Schema::table('payment_informations', function (Blueprint $table) {
        $table->text('program')->change(); // Change to TEXT to store JSON
        // OR if your database supports JSON type:
        // $table->json('program')->change();
    });
}

public function down()
{
    Schema::table('payment_informations', function (Blueprint $table) {
        $table->string('program', 255)->change(); // Revert if needed
    });
}
};
