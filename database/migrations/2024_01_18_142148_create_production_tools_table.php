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
        Schema::create('production_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->references('id')->on('productions')->onDelete('cascade');
            $table->foreignId('tool_id')->references('id')->on('tools')->onDelete('cascade');
            $table->string('tool_name');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_tools');
    }
};
