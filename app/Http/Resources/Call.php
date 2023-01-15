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
            'caller_user' => (new UserResource($this->whenLoaded('caller_user'))),
            'receiver_user' => (new UserResource($this->whenLoaded('receiver_user'))),
            'created_at' => $this->created_at->format('d/m/Y'),
        ]
    }
}
