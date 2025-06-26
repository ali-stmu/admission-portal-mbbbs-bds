<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payment_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->enum('program', ['mbbs', 'bds', 'both']);
            $table->decimal('amount', 10, 2);
            $table->enum('payment_mode', ['voucher', 'atm', 'online', 'foreign']);
            $table->date('payment_date');
            $table->string('payment_proof_path');
            $table->string('transaction_id')->nullable();
            $table->text('payment_details')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_informations');
    }
};