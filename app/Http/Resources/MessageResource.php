<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => new UserResource($this->customer),
            'manager' => new UserResource($this->manager),
            'sender' => new UserResource($this->sender),
            'title' => $this->title,
            'body' => $this->body,
            'seen_by_customer' => $this->isSeenByCustomer(),
            'seen_by_manager' => $this->isSeenByManager(),
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
        ];
    }
}
