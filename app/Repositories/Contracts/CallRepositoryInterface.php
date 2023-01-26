<?php

namespace App\Repositories\Contracts;

interface CallRepositoryInterface
{
    public function getAllCalls();
    public function getCallBySid($sid);
    public function createCall(array $call);
    public function updateCall(string $sid, array $call);
}
