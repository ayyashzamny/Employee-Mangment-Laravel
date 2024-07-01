<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /** 
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annual_leaves', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->year('year');
            $table->integer('total_casual_leaves');
            $table->integer('total_medical_leaves');
            $table->integer('balance_casual_leaves');
            $table->integer('balance_medical_leaves');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_leaves');
    }
};
