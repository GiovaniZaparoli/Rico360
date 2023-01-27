<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserByPhone(string $phone);
    public function createUser(array $params);
    public function forgotPassword(string $email);
    public function updatePassword(array $params);
}
