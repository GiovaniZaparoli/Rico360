<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $entity;

    public function __construct(User $user)
    {
        $this->entity = $user;
    }

    public function getAllUsers()
    {
        return $this->entity->paginate();
    }

    public function getUserByPhone(string $phone)
    {
        return $this->entity->where('phone', $phone)->first();
    }

    public function createUser(array $params)
    {
        return $this->entity->create($params);
    }

    public function forgotPassword(string $email)
    {
        return Password::sendResetLink($email);
    }

    public function updatePassword(array $params)
    {
        $reset_password_status = Password::reset($params, function ($user, $password) {
            $user->password = $password;
            $user->c_password = $password;
            $user->save();
        });

        return $reset_password_status;
    }
}
