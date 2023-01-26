<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserByPhone(string $phone);
    public function createUser(array $params);
}
