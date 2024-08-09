<?php

namespace Tests\Feature\Admin\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_guest_can_login()
    {
        // Validation needed, validate roles and permissions before do this test
        $response = $this->post('/admin/login', [
            'email' => 'ti@traumtor.com.br',
            'password' => 'PP2024!@#$%',
        ]);
        $response->assertRedirect('/admin');
        $this->get('/admin')->assertSee('Dashboard');
    }

    /** @test */
    public function a_guest_cannot_login_with_invalid_data()
    {
        $this->get('/admin/login')->assertSee('Faça seu login agora');
        $response = $this->post('/admin/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalid',
        ]);
        $response->assertSessionHasErrors('email');
    }
}
