<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Execute o seeder ModalitiesTableSeeder
        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\ModalitiesTableSeeder'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Se necessário, remova os dados inseridos pelo seeder
        DB::table('modalities')->whereIn('name', ['Campo', 'Futsal', 'Society'])->delete();
    }
};
