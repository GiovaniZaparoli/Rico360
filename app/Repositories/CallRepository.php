<?php

namespace App\Repositories;

use App\Models\Call;
use App\Repositories\Contracts\CallRepositoryInterface;

class CallRepository implements CallRepositoryInterface
{
    protected $entity;

    public function __construct(Call $call)
    {
        $this->entity = $call;
    }

    public function getAllCalls()
    {
        return $this->entity->paginate();
    }

    public function getCallBySid(string $sid)
    {
        return $this->entity->where('call_sid', $sid)->first();
    }

    public function createCall(array $params)
    {
        return $this->entity->create($params);
    }

    public function updateCall(object $call, array $params)
    {
        return $call->update($params);
    }
}
