<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('rank')->nullable()->change();
            $table->string('division')->nullable()->change();
            $table->string('badge_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('officers', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('rank')->nullable(false)->change();
            $table->string('division')->nullable(false)->change();
            $table->string('badge_number')->nullable(false)->change();
        });
    }
};
