<?php

namespace App\Services;

use App\Repositories\Contracts\TwilioRepositoryInterface;

class TwilioService
{
    protected $twilioRepository;

    public function __construct(TwilioRepositoryInterface $twilioRepository)
    {
        $this->twilioRepository = $twilioRepository;
    }

    public function getToken()
    {
        $token = $this->twilioRepository->getToken();
        return ['token' => $token];
    }

    public function makeVoice(string $toNumber)
    {
        return $this->twilioRepository->makeVoice($toNumber);
    }
}
