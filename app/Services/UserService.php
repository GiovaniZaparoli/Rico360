<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->callRepository->getAllUsers();
    }

    public function getUserByPhone(string $phone)
    {
        return $this->callRepository->getUserByPhone($phone);
    }

    public function createUser(array $params)
    {
        $params['password'] = bcrypt($params['password']);
        $user = $this->userRepository->createUser($params);
        $response['token'] = $user->createToken('JobTest')->accessToken;
        $response['name'] = $user->name;
        return $success
    }
}
