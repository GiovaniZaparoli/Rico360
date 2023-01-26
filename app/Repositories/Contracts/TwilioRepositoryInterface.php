<?php

namespace App\Repositories\Contracts;

interface TwilioRepositoryInterface
{
    public function getToken();
    public function makeVoice(string $toNumber);
}
