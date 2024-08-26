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
        Schema::table('football_matches', function (Blueprint $table) {
           
            $table->dropColumn(['local_name', 'address', 'city', 'state', 'zip_code', 'scheduled_by', 'modality_id']);          
           
            $table->unsignedBigInteger('group_modality_schedule_id')->after('match_datetime');            
            
            $table->foreign('group_modality_schedule_id')->references('id')->on('group_modality_schedule')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('football_matches', function (Blueprint $table) {
           
            $table->string('local_name', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('state', 255)->nullable();
            $table->string('zip_code', 255)->nullable();
            $table->unsignedBigInteger('scheduled_by')->nullable();
            $table->unsignedBigInteger('modality_id')->nullable();
            
            
            $table->dropForeign(['group_modality_schedule_id']);
            $table->dropColumn('group_modality_schedule_id');
        });
    }
};
