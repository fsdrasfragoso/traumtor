<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\NewUserNotification;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * Register new user.
     *
     * @param $attributes
     */
    public function register($attributes)
    {
        $repository = new UserRepository();

        /** @var User $user */
        if ($user = $repository->create($attributes)) {
            $user->notify(new NewUserNotification($attributes['password']));
        }

        return $user;
    }
}
