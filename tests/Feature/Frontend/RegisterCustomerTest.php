<?php

namespace Tests\Feature\Frontend;

use App\Models\Footballer;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterFootballerTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function a_guest_can_register_with_a_zipcode_that_does_not_exist()
    {
        $response = $this->post('/cadastro', [
            'email' => $email = fake()->email,
            'name' => 'John Doe',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
            'document' => $document = $this->faker->cpf,
            'phone' => $phone = '(84) 99999-' . $this->faker->numberBetween(1000, 9998),
            'zip_code' => $zipcode = '00000-' . $this->faker->numberBetween(100, 999), // zip code not registered
            'street' => 'Avenida das Tulipas',
            'number' => '1849',
            'neighborhood' => 'Capim Macio',
            'complement' => 'Teste',
            'state' => 'RN',
            'city' => 'Natal',
            'terms' => 1,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('footballers', [
            'email' => $email,
            'name' => 'John Doe',
        ]);
        $footballer = Footballer::where('email', $email)->first();
        $this->assertDatabaseHas('addresses', [
            'footballer_id' => $footballer->id,
            'zip_code' => $zipcode,
            'street' => 'Avenida das Tulipas',
            'number' => '1849',
            'neighborhood' => 'Capim Macio',
            'complement' => 'Teste',
            'state' => 'RN',
            'city' => 'Natal',
        ]);
    }

    /** @test */
    public function a_guest_cant_register_with_a_zipcode_with_only_zero()
    {
        $response = $this->post('/cadastro', [
            'email' => $email = fake()->email,
            'name' => 'John Doe',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
            'document' => $this->faker->cpf,
            'mobile' => '(84) 99999-' . $this->faker->numberBetween(1000, 9998),
            'zip_code' => '00000-000', // invalid zip code
            'street' => 'Avenida das Tulipas',
            'number' => '1849',
            'birth_date' => '01/01/1990',
            'neighborhood' => 'Capim Macio',
            'complement' => 'Mobister',
            'state' => 'RN',
            'city' => 'Natal',
            'city_code' => 2408102, // Natal
            'terms' => 1,
        ]);
        $response->assertSessionHasErrors('zip_code');
        $this->assertDatabaseMissing('footballers', [
            'email' => $email,
        ]);
    }
}
