<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ActivityResource extends JsonResource
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
            'causer' => new ImpersonatorResource($this->causer),
            'status' => $this->changes['attributes']['status'],
            'type' => $this->description,
            'created_at' => $this->created_at->diffForHumans(),
            'class' => Str::plural(strtolower(class_basename($this->subject_type))),
        ];
    }
}
