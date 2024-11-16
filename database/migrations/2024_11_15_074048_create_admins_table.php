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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Admin's name
            $table->string('email')->unique(); // Admin's email, unique to avoid duplicates
            $table->string('mobile')->nullable(); // Admin's mobile number, nullable in case it's optional
            $table->string('password');        // Admin's password, to be hashed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
