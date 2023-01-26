<?php

namespace App\Repositories;

use Twilio\Jwt\AccessToken;
use Twilio\TwiML\VoiceResponse;
use Twilio\Jwt\Grants\VoiceGrant;
use App\Repositories\Contracts\TwilioRepositoryInterface;

class TwilioRepository implements TwilioRepositoryInterface
{

    public function getToken()
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
        return $token;
    }

    public function makeVoice(string $toNumber)
    {
        $response = new VoiceResponse();
        $dial = $response->dial(null, ['callerId' => $_ENV['TWILIO_NUMBER']]);

        if (isset($toNumber)) {
            $dial->number($toNumber);
        } else {
            $dial->client('support_agent');
        }

        return $response
    }
}
