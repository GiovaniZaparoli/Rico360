<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CallRepositoryInterface;

class CallService
{
    protected $callRepository;

    public function __construct(CallRepositoryInterface $callRepository)
    {
        $this->callRepository = $callRepository;
    }

    public function getAllCalls()
    {
        return $this->callRepository->getAllCalls();
    }

    public function getCallBySid(string $sid)
    {
        return $this->callRepository->getCallBySid($sid);
    }

    public function createCall(Request $params)
    {
        $call_params = [
            'receiver_user_id' => User::where('phone', '=', $params->To)->first()->id,
            'call_sid' => $params->CallSid,
            'status' => $params->CallStatus,
        ];

        return $this->callRepository->createCall($call_params);
    }

    public function updateCall(string $sid, array $params)
    {
        $call = $this->callRepository->getCallBySid($sid);

        if (!$call) {
            return response()->json(['message' => 'Call not found'], 404);
        }

        $this->callRepository->updateCall($call, $params);
        return response()->json(['message' => 'Call updated'], 200);
    }
}
