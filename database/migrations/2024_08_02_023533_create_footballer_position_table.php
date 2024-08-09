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
        Schema::create('footballer_position', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('footballer_id');
            $table->unsignedBigInteger('position_id');
            $table->timestamps();

            $table->foreign('footballer_id')->references('id')->on('footballers')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
            $table->unique(['footballer_id', 'position_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('footballer_position');
    }
};
