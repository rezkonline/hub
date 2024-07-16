<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'start_at' => $this->start_at->format('Y-m-d H:i'),
            'start_at_formatted' => $this->start_at->diffForHumans(),
            'is_finished' => $this->isFinished(),
            'is_started' => $this->isStarted(),
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
