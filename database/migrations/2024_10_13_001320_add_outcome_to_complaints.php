<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOutcomeToComplaints extends Migration
{
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->enum('outcome', ['founded', 'unfounded'])->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('outcome');
        });
    }
}