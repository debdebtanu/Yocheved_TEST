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
        Schema::create('target_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('target');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_data');
    }
};
