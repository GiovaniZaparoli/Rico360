<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Call extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'call_sid' => $this->call_sid,
            'status' => $this->status,
            'duration' => $this->duration,
            'receiver_user' => new UserResource($this->receiver),
            'created_at' => $this->created_at->format('m/d/Y H:m'),
        ];
    }
}
