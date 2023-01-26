<?php

namespace App\Repositories;

use App\Models\User;
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
}
