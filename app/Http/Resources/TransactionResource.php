<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'payment_type' => $this->payment_type,
            'amount' => $this->amount,
            'actor' => $this->actor->name,
            'note' => $this->note,
            'receipt' => $this->getReceipt(),
            'type' => $this->type,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
