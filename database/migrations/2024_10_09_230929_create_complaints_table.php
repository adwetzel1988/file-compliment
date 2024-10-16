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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('complaint_number')->unique();
            $table->text('description');
            $table->dateTime('incident_date');
            $table->enum('status', ['pending', 'in_progress', 'under_review', 'completed'])->default('pending');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->timestamps();
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
