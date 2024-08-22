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
        Schema::create('group_footballer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')
                ->constrained('groups')
                ->onDelete('cascade')
                ->comment('Foreign key referencing groups table');
            $table->foreignId('footballer_id')
                ->constrained('footballers')
                ->onDelete('cascade')
                ->comment('Foreign key referencing footballers table');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_footballer');
    }
};
