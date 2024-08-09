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
        Schema::table('footballers', function (Blueprint $table) {
            $table->decimal('height', 5, 2)->nullable()->after('status'); // Height in meters, e.g., 1.75
            $table->decimal('weight', 5, 2)->nullable()->after('height'); // Weight in kilograms, e.g., 70.50
            $table->enum('dominant_foot', ['right', 'left', 'ambidextrous'])->default('right')->after('weight'); // Dominant foot
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('footballers', function (Blueprint $table) {
            $table->dropColumn(['height', 'weight', 'dominant_foot']);
        });
    }
};
