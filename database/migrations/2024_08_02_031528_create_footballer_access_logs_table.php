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
        Schema::create('footballer_access_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('footballer_id')->index();
            $table->string('ip_address')->nullable();
            $table->dateTime('logged_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footballer_access_logs');
    }
};
