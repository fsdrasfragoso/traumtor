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
        // Create the 'markings' table
        Schema::create('markings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('advantages');
            $table->text('disadvantages');
            $table->unsignedBigInteger('modality_id');
            $table->timestamps();

            $table->foreign('modality_id')->references('id')->on('modalities')->onDelete('cascade');
        });

        
    }

   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markings');
    }
};
