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
        // Execute o seeder PositionsTableSeeder
        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\PositionsTableSeeder'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Se necessário, remova os dados inseridos pelo seeder
        DB::table('positions')->whereIn('name', [
            'Goleiro', 'Zagueiro', 'Líbero', 'Lateral', 'Volante', 'Ala', 
            'Meia de contenção', 'Meia de armação', 'Meia extremado', 'Meia atacante', 
            'Atacante recuado', 'Atacante de beirada', 'Atacante de área', 
            'Fixo', 'Pivô', 'Goleiro Linha', 'Meia', 'Atacante'
        ])->delete();
    }
};
