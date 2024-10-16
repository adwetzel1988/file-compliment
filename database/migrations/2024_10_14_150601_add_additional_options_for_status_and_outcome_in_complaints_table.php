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
        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'under_review', 'completed', 'submitted'])
                ->default('pending')
                ->change();
            $table->enum('outcome', ['founded', 'unfounded', 'exonerated', 'not sustained', 'sustained', 'other sustained misconduct'])
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'under_review', 'completed'])
                ->default('pending')
                ->change();
            $table->enum('outcome', ['founded', 'unfounded'])
                ->nullable()
                ->change();
        });
    }
};
