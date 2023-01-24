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


class TwilioController extends BaseController
{

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
        echo $request;
        // $response = new VoiceResponse();
        // $dial = $response->dial('', ['callerId' => $_ENV['TWILIO_NUMBER']]);
        // $dial->number($request->to);

        // echo $response;
    }
}
