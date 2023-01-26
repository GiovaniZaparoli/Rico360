<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\CallService;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;


class TwilioController extends BaseController
{
    protected $callService;
    protected $twilioService;

    public function __construct(CallService $callService, TwilioService $twilioService)
    {
        $this->callService = $callService;
        $this->twilioService = $twilioService;
    }

    public function token()
    {
        $response = $this->twilioService.getToken();
        return $response;
    }

    public function voice(Request $request)
    {
        $this->callService->createCall($request->all());
        $response = $this->twilioService->makeVoice($request->To);
        return $response;
    }

    public function callback(Request $request)
    {
        $response = $this->callService->updateCall($request->CallSid, $request->all());
        return $response;
    }
}
