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
        Schema::create('quiz_dtl', function (Blueprint $table) {    
            $table->id();  // Auto-incrementing ID
            $table->string('title');  // Quiz title
            $table->date('date');  // Date of the quiz
            $table->time('time');  // Time of the quiz (start time)
            $table->integer('duration');  // Duration of the quiz in minutes
            $table->enum('active', ['enable', 'disable'])->default('enable');  // Active status (enabled/disabled)
            $table->string('url_slug')->unique();  // Unique slug for accessing the quiz

            $table->timestamps();  // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_dtl');
    }
};
