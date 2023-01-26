<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Call;
use Twilio\Jwt\AccessToken;
use Illuminate\Http\Request;
use Twilio\TwiML\VoiceResponse;
use Twilio\Jwt\Grants\VoiceGrant;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Services\CallService;


class TwilioController extends BaseController
{
    protected $callService;

    public function __construct(CallService $callService)
    {
        $this->callService = $callService;
    }

    public function token()
    {
        $access_token = new AccessToken(
            $_ENV['TWILIO_ACCOUNT_SID'],
            $_ENV['API_KEY'],
            $_ENV['API_SECRET'],
            3600
        );

        $voice_grant = new VoiceGrant();
        $voice_grant->setOutgoingApplicationSid($_ENV['TWILIO_TWIML_APP_SID']);
        $voice_grant->setIncomingAllow(false);
        $access_token->addGrant($voice_grant);

        $token = $access_token->toJWT();

        return ['token' => $token];
    }

    public function voice(Request $request)
    {
        $this->callService->createCall($request);

        $response = new VoiceResponse();
        $dial = $response->dial(null, ['callerId' => $_ENV['TWILIO_NUMBER']]);
        $phoneNumberToDial = $request->To;

        if (isset($phoneNumberToDial)) {
            $dial->number($phoneNumberToDial);
        } else {
            $dial->client('support_agent');
        }

        return $response;
    }

    public function callback(Request $request)
    {
        file_put_contents("php://stderr", $request.PHP_EOL);

        return $response;
    }
}
