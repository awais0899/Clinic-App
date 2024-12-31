<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if the table already exists before creating it
        Schema::create('therapists', function (Blueprint $table) {
            $table->id();
            // ... other columns ...
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('therapist_id')->nullable();
            // $table->foreign('therapist_id')->references('id')->on('therapists')->onDelete('set null');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('menus')->onDelete('cascade');
            $table->dateTime('time');
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('therapists');
    }
};