<?php

namespace App\Services;

use App\Repositories\Contracts\CallRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class CallService
{
    protected $callRepository;
    protected $userRepository;

    public function __construct(CallRepositoryInterface $callRepository, UserRepositoryInterface $userRepository)
    {
        $this->callRepository = $callRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllCalls()
    {
        return $this->callRepository->getAllCalls();
    }

    public function getCallBySid(string $sid)
    {
        return $this->callRepository->getCallBySid($sid);
    }

    public function createCall(array $params)
    {
        $call_params = [
            'receiver_user_id' => $this->userRepository->getUserByPhone($params['To'])->id,
            'call_sid' => $params['CallSid'],
            'status' => $params['CallStatus'],
        ];

        return $this->callRepository->createCall($call_params);
    }

    public function updateCall(string $sid, array $params)
    {
        $call = $this->callRepository->getCallBySid($sid);

        if (!$call) {
            return response()->json(['message' => 'Call not found'], 404);
        }

        $call_params = [
            'status' => $params['CallStatus'],
            'duration' => $params['Duration'],
        ];

        $this->callRepository->updateCall($call, $call_params);
        return response()->json(['message' => 'Call updated'], 200);
    }
}
