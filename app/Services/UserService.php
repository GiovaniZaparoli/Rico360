<?php

namespace App\Services;

use Illuminate\Support\Facades\Password;
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
        $params['status'] = 'online';
        $user = $this->userRepository->createUser($params);
        $response['token'] = $user->createToken('JobTest')->accessToken;
        $response['name'] = $user->name;
        return $response;
    }

    public function forgotPassword(string $email)
    {
        $this->userRepository->forgotPassword($email);
    }

    public function updatePassword(array $params)
    {
        $reset_status = $this->userRepository->updatePassword($params);

        if ($reset_status == Password::INVALID_TOKEN) {
            return response()->json(['message' => 'Invalid token provided'], 400);
        }

        return response()->json(['message' => 'Password has been successfully changed'], 200);
    }
}
