<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\RolesTableSeeder'
        ]);
        
        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\UsersTableSeeder'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Coloque aqui o código para reverter a migração, se necessário
    }
};
