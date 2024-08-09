<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signInUser($user = null)
    {
        if (!$user) {
            $role = Role::where('name', 'Administrador (super)')->first();
            $user = User::factory()
                ->hasAttached($role)
                ->create();
        }

        $this->actingAs($user, 'users');
        return $user;
    }
}
