<?php

namespace Database\Factories;

use App\Models\Footballer;
use App\Models\Export;
use App\Models\User;
use App\Repositories\FootballerRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExportFactory extends Factory
{
    protected $model = \App\Models\Export::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'model' => Footballer::class,
            'repository' => FootballerRepository::class,
            'status' => Export::STATUS_SUCCESS,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
