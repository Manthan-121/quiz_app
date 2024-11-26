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
        Schema::create('stud_info', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('email')->unique();
            $table->string('mobile', 15)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stud_info');
    }
};
