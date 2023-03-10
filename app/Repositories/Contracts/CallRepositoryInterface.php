<?php

namespace App\Repositories\Contracts;

interface CallRepositoryInterface
{
    public function getAllCalls(array $params);
    public function getCallBySid(string $sid);
    public function createCall(array $params);
    public function updateCall(object $call, array $params);
}
