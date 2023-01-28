<?php

namespace App\Repositories;

use App\Models\Call;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Repositories\Contracts\CallRepositoryInterface;

class CallRepository implements CallRepositoryInterface
{
    protected $entity;

    public function __construct(Call $call)
    {
        $this->entity = $call;
    }

    public function getAllCalls(array $params)
    {
        $response = QueryBuilder::For(Call::class)->allowedFilters([AllowedFilter::exact('id'),
                                                                    AllowedFilter::exact('call_sid'),
                                                                    AllowedFilter::exact('status')])
                                                    ->defaultSort('-created_at')
                                                    ->allowedSorts('created_at', '-created_at')
                                                    ->paginate($params['per_page'])
                                                    ->appends(request()->query());
        return $response;
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
