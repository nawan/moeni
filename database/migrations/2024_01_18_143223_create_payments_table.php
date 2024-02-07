<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('production_id')->references('id')->on('productions')->onDelete('cascade');
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->double('total_price');
            $table->double('payment_amount')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('payment_code');
            $table->string('received_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
